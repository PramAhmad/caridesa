<?php
<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     */
    public function index(Request $request)
    {
        try {
            $query = Event::with(['images']);
            
            // Search functionality
            if ($request->filled('search')) {
                $search = $request->get('search');
                $query->search($search);
            }
            
            // Filter by status
            if ($request->filled('status')) {
                $status = $request->get('status');
                switch ($status) {
                    case 'upcoming':
                        $query->upcoming();
                        break;
                    case 'ongoing':
                        $query->ongoing();
                        break;
                    case 'past':
                        $query->past();
                        break;
                    case 'active':
                        $query->active();
                        break;
                }
            }
            
            // Filter by date range
            if ($request->filled('start_date') && $request->filled('end_date')) {
                $startDate = Carbon::parse($request->get('start_date'));
                $endDate = Carbon::parse($request->get('end_date'));
                $query->dateRange($startDate, $endDate);
            }
            
            // Order by start date (newest first by default)
            $orderBy = $request->get('order_by', 'start_date');
            $orderDirection = $request->get('order_direction', 'desc');
            
            if ($orderBy === 'start_date') {
                $query->orderByStartDate($orderDirection);
            } else {
                $query->orderBy($orderBy, $orderDirection);
            }
            
            $events = $query->paginate(12);
            
            return view('tenant.events.index', compact('events'));
            
        } catch (Exception $e) {
            Log::error('Error fetching events: ' . $e->getMessage());
            return back()->with('error', 'Gagal memuat daftar acara. Silakan coba lagi.');
        }
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        try {
            return view('tenant.events.create');
        } catch (Exception $e) {
            Log::error('Error loading create event form: ' . $e->getMessage());
            return redirect('/admin/events')->with('error', 'Gagal memuat halaman tambah acara.');
        }
    }

    /**
     * Store a newly created event.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        
        try {
            // Validation
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:events,name',
                'description' => 'required|string',
                'start_date' => 'required|date|after_or_equal:today',
                'end_date' => 'required|date|after_or_equal:start_date',
                'location' => 'required|string|max:255',
                'organizer' => 'nullable|string|max:255',
                'contact_email' => 'nullable|email|max:255',
                'contact_phone' => 'nullable|string|max:20',
                'is_active' => 'boolean',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.required' => 'Nama acara wajib diisi.',
                'name.unique' => 'Nama acara sudah digunakan.',
                'name.max' => 'Nama acara maksimal 255 karakter.',
                'description.required' => 'Deskripsi acara wajib diisi.',
                'start_date.required' => 'Tanggal mulai wajib diisi.',
                'start_date.date' => 'Format tanggal mulai tidak valid.',
                'start_date.after_or_equal' => 'Tanggal mulai tidak boleh kurang dari hari ini.',
                'end_date.required' => 'Tanggal selesai wajib diisi.',
                'end_date.date' => 'Format tanggal selesai tidak valid.',
                'end_date.after_or_equal' => 'Tanggal selesai tidak boleh kurang dari tanggal mulai.',
                'location.required' => 'Lokasi acara wajib diisi.',
                'location.max' => 'Lokasi acara maksimal 255 karakter.',
                'organizer.max' => 'Nama penyelenggara maksimal 255 karakter.',
                'contact_email.email' => 'Format email tidak valid.',
                'contact_email.max' => 'Email maksimal 255 karakter.',
                'contact_phone.max' => 'Nomor telepon maksimal 20 karakter.',
                'images.*.image' => 'File harus berupa gambar.',
                'images.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'images.*.max' => 'Ukuran gambar maksimal 2MB.',
            ]);

            // Convert dates to proper format
            $validated['start_date'] = Carbon::parse($validated['start_date']);
            $validated['end_date'] = Carbon::parse($validated['end_date']);
            $validated['slug'] = Str::slug($validated['name']);
            $validated['is_active'] = $request->has('is_active');

            // Create event
            $event = Event::create($validated);
            
            if (!$event) {
                throw new Exception('Gagal menyimpan data acara ke database.');
            }

            // Handle image uploads
            if ($request->hasFile('images')) {
                $this->handleImageUpload($request->file('images'), $event->id);
            }

            DB::commit();
            
            Log::info("Event created successfully: ID {$event->id}, Name: {$event->name}");

            return redirect('/admin/events')
                            ->with('success', 'Acara berhasil dibuat!');

        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning('Validation failed for event creation: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
            
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Database error creating event: ' . $e->getMessage());
            
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return back()->with('error', 'Nama acara sudah digunakan. Silakan gunakan nama lain.')->withInput();
            }
            
            return back()->with('error', 'Gagal menyimpan acara ke database. Silakan coba lagi.')->withInput();
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating event: ' . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['images'])
            ]);
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified event.
     */
    public function show(Event $event)
    {
        try {
            $event->load(['images']);
            return view('tenant.events.show', compact('event'));
        } catch (Exception $e) {
            Log::error("Error loading event details: ID {$event->id}, Error: " . $e->getMessage());
            return redirect('/admin/events')->with('error', 'Gagal memuat detail acara.');
        }
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        try {
            $event->load(['images']);
            return view('tenant.events.edit', compact('event'));
        } catch (Exception $e) {
            Log::error("Error loading edit event form: ID {$event->id}, Error: " . $e->getMessage());
            return redirect('/admin/events')->with('error', 'Gagal memuat halaman edit acara.');
        }
    }

    /**
     * Update the specified event.
     */
    public function update(Request $request, Event $event)
    {
        DB::beginTransaction();
        
        try {
            // Validation
            $validated = $request->validate([
                'name' => 'required|string|max:255|unique:events,name,' . $event->id,
                'description' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'location' => 'required|string|max:255',
                'organizer' => 'nullable|string|max:255',
                'contact_email' => 'nullable|email|max:255',
                'contact_phone' => 'nullable|string|max:20',
                'is_active' => 'boolean',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'name.required' => 'Nama acara wajib diisi.',
                'name.unique' => 'Nama acara sudah digunakan.',
                'name.max' => 'Nama acara maksimal 255 karakter.',
                'description.required' => 'Deskripsi acara wajib diisi.',
                'start_date.required' => 'Tanggal mulai wajib diisi.',
                'start_date.date' => 'Format tanggal mulai tidak valid.',
                'end_date.required' => 'Tanggal selesai wajib diisi.',
                'end_date.date' => 'Format tanggal selesai tidak valid.',
                'end_date.after_or_equal' => 'Tanggal selesai tidak boleh kurang dari tanggal mulai.',
                'location.required' => 'Lokasi acara wajib diisi.',
                'location.max' => 'Lokasi acara maksimal 255 karakter.',
                'organizer.max' => 'Nama penyelenggara maksimal 255 karakter.',
                'contact_email.email' => 'Format email tidak valid.',
                'contact_email.max' => 'Email maksimal 255 karakter.',
                'contact_phone.max' => 'Nomor telepon maksimal 20 karakter.',
                'images.*.image' => 'File harus berupa gambar.',
                'images.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'images.*.max' => 'Ukuran gambar maksimal 2MB.',
            ]);

            // Convert dates to proper format
            $validated['start_date'] = Carbon::parse($validated['start_date']);
            $validated['end_date'] = Carbon::parse($validated['end_date']);
            $validated['is_active'] = $request->has('is_active');

            // Only update slug if name changed
            if ($event->name !== $validated['name']) {
                $validated['slug'] = Str::slug($validated['name']);
            }

            // Update event
            $updated = $event->update($validated);
            
            if (!$updated) {
                throw new Exception('Gagal memperbarui data acara.');
            }

            // Handle new image uploads
            if ($request->hasFile('images')) {
                $this->handleImageUpload($request->file('images'), $event->id);
            }

            DB::commit();
            
            Log::info("Event updated successfully: ID {$event->id}, Name: {$event->name}");

            return redirect('/admin/events')
                            ->with('success', 'Acara berhasil diperbarui!');

        } catch (ValidationException $e) {
            DB::rollBack();
            Log::warning("Validation failed for event update: ID {$event->id}, Errors: " . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
            
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error("Database error updating event: ID {$event->id}, Error: " . $e->getMessage());
            
            if (str_contains($e->getMessage(), 'Duplicate entry')) {
                return back()->with('error', 'Nama acara sudah digunakan. Silakan gunakan nama lain.')->withInput();
            }
            
            return back()->with('error', 'Gagal memperbarui acara ke database. Silakan coba lagi.')->withInput();
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error updating event: ID {$event->id}, Error: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['images'])
            ]);
            
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified event.
     */
    public function destroy(Event $event)
    {
        DB::beginTransaction();
        
        try {
            $eventName = $event->name;
            $eventId = $event->id;
            
            // Delete associated images from filesystem and database
            foreach ($event->images as $image) {
                $this->deleteImageFile($image);
                $image->delete();
            }

            // Delete event
            $deleted = $event->delete();
            
            if (!$deleted) {
                throw new Exception('Gagal menghapus acara dari database.');
            }

            DB::commit();
            
            Log::info("Event deleted successfully: ID {$eventId}, Name: {$eventName}");

            return back()->with('success', 'Acara berhasil dihapus!');

        } catch (QueryException $e) {
            DB::rollBack();
            Log::error("Database error deleting event: ID {$event->id}, Error: " . $e->getMessage());
            
            if (str_contains($e->getMessage(), 'foreign key constraint')) {
                return back()->with('error', 'Tidak dapat menghapus acara karena masih terkait dengan data lain.');
            }
            
            return back()->with('error', 'Gagal menghapus acara dari database. Silakan coba lagi.');
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error deleting event: ID {$event->id}, Error: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat menghapus acara: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified image from event.
     */
    public function deleteImage(EventImage $image)
    {
        DB::beginTransaction();
        
        try {
            $imageName = $image->name;
            $eventId = $image->event_id;
            
            // Delete image file from filesystem
            $this->deleteImageFile($image);
            
            // Delete image record from database
            $deleted = $image->delete();
            
            if (!$deleted) {
                throw new Exception('Gagal menghapus record gambar dari database.');
            }

            DB::commit();
            
            Log::info("Event image deleted successfully: Image {$imageName}, Event ID {$eventId}");

            return back()->with('success', 'Gambar berhasil dihapus!');

        } catch (QueryException $e) {
            DB::rollBack();
            Log::error("Database error deleting event image: ID {$image->id}, Error: " . $e->getMessage());
            return back()->with('error', 'Gagal menghapus gambar dari database. Silakan coba lagi.');
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error deleting event image: ID {$image->id}, Error: " . $e->getMessage(), [
                'stack_trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Terjadi kesalahan saat menghapus gambar: ' . $e->getMessage());
        }
    }

    /**
     * Get upcoming events for calendar/dashboard
     */
    public function upcoming()
    {
        try {
            $upcomingEvents = Event::active()
                                  ->upcoming()
                                  ->with(['images'])
                                  ->orderByStartDate('asc')
                                  ->limit(5)
                                  ->get();
                                  
            return response()->json([
                'success' => true,
                'data' => $upcomingEvents
            ]);
            
        } catch (Exception $e) {
            Log::error('Error fetching upcoming events: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat acara mendatang.'
            ], 500);
        }
    }

    /**
     * Get ongoing events
     */
    public function ongoing()
    {
        try {
            $ongoingEvents = Event::active()
                                 ->ongoing()
                                 ->with(['images'])
                                 ->orderByStartDate('asc')
                                 ->get();
                                 
            return response()->json([
                'success' => true,
                'data' => $ongoingEvents
            ]);
            
        } catch (Exception $e) {
            Log::error('Error fetching ongoing events: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat acara yang sedang berlangsung.'
            ], 500);
        }
    }

    /**
     * Toggle event status (active/inactive)
     */
    public function toggleStatus(Event $event)
    {
        DB::beginTransaction();
        
        try {
            $event->is_active = !$event->is_active;
            $updated = $event->save();
            
            if (!$updated) {
                throw new Exception('Gagal mengubah status acara.');
            }
            
            DB::commit();
            
            $status = $event->is_active ? 'diaktifkan' : 'dinonaktifkan';
            Log::info("Event status toggled: ID {$event->id}, Status: {$status}");
            
            return back()->with('success', "Acara berhasil {$status}!");
            
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error toggling event status: ID {$event->id}, Error: " . $e->getMessage());
            
            return back()->with('error', 'Gagal mengubah status acara: ' . $e->getMessage());
        }
    }

    /**
     * Handle image upload process
     */
    private function handleImageUpload($images, $eventId)
    {
        try {
            $uploadPath = public_path("tenancy/assets/image/events");
            
            // Create directory if not exists
            if (!File::exists($uploadPath)) {
                $created = File::makeDirectory($uploadPath, 0755, true);
                if (!$created) {
                    throw new Exception('Gagal membuat direktori upload: ' . $uploadPath);
                }
            }
            
            // Check if directory is writable
            if (!is_writable($uploadPath)) {
                throw new Exception('Direktori upload tidak dapat ditulis: ' . $uploadPath);
            }
            
            foreach ($images as $image) {
                // Generate unique filename
                $filename = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $fullPath = $uploadPath . '/' . $filename;
                
                // Move uploaded file
                $moved = $image->move($uploadPath, $filename);
                
                if (!$moved) {
                    throw new Exception("Gagal memindahkan file gambar: {$image->getClientOriginalName()}");
                }
                
                // Verify file was actually created
                if (!File::exists($fullPath)) {
                    throw new Exception("File gambar tidak ditemukan setelah upload: {$filename}");
                }
                
                // Create database record
                $imageRecord = EventImage::create([
                    'name' => '/image/events/' . $filename,
                    'event_id' => $eventId,
                ]);
                
                if (!$imageRecord) {
                    // Delete uploaded file if database insert failed
                    File::delete($fullPath);
                    throw new Exception("Gagal menyimpan record gambar ke database: {$filename}");
                }
                
                Log::info("Event image uploaded successfully: {$filename} for event ID {$eventId}");
            }
            
        } catch (Exception $e) {
            Log::error("Error uploading event images: " . $e->getMessage(), [
                'event_id' => $eventId,
                'upload_path' => $uploadPath ?? 'undefined'
            ]);
            throw $e;
        }
    }

    /**
     * Delete image file from filesystem
     */
    private function deleteImageFile(EventImage $image)
    {
        try {
            $imagePath = public_path("tenancy/assets" . $image->name);
            
            if (File::exists($imagePath)) {
                $deleted = File::delete($imagePath);
                if (!$deleted) {
                    Log::warning("Failed to delete image file: {$imagePath}");
                } else {
                    Log::info("Image file deleted successfully: {$imagePath}");
                }
            } else {
                Log::warning("Image file not found for deletion: {$imagePath}");
            }
            
        } catch (Exception $e) {
            Log::error("Error deleting image file: " . $e->getMessage(), [
                'image_id' => $image->id,
                'image_path' => $imagePath ?? 'undefined'
            ]);
        }
    }
}