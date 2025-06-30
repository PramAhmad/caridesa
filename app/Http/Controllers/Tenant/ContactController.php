<?php
// app/Http/Controllers/Tenant/ContactController.php
namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\TenantContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:1000|min:10',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal 2 karakter.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'phone.max' => 'Nomor telepon maksimal 20 karakter.',
            'subject.max' => 'Subjek maksimal 255 karakter.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min' => 'Pesan minimal 10 karakter.',
            'message.max' => 'Pesan maksimal 1000 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Create contact model for tenant database
            $contact = TenantContact::create([
                'tenant_id' => tenant('id'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'subject' => $request->input('subject'),
                'message' => $request->input('message'),
            ]);

            // Optional: Send email notification to tenant admin
            try {
                $this->sendNotificationEmail($contact);
            } catch (\Exception $e) {
                Log::error('Failed to send tenant contact email: ' . $e->getMessage());
            }

            return response()->json([
                'success' => true,
                'message' => 'Pesan Anda telah berhasil dikirim! Kami akan segera menghubungi Anda melalui email atau WhatsApp.',
                'data' => [
                    'id' => $contact->id,
                    'name' => $contact->name,
                    'email' => $contact->email,
                    'created_at' => $contact->created_at->format('d M Y, H:i')
                ]
            ], 200);

        } catch (\Exception $e) {
            Log::error('Tenant contact form error: ' . $e->getMessage(), [
                'tenant_id' => tenant('id'),
                'request_data' => $request->except(['_token'])
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi atau hubungi kami melalui WhatsApp di +62 821 1337 2046.'
            ], 500);
        }
    }

    /**
     * Send notification email to tenant admin
     */
   

    /**
     * View all contact messages for tenant admin
     */
    public function index()
{
    $contacts = TenantContact::where('tenant_id', tenant('id'))
        ->orderBy('created_at', 'desc')
        ->paginate(20);
    
    // Add statistics data
    $stats = [
        'total' => TenantContact::where('tenant_id', tenant('id'))->count(),
        'today' => TenantContact::where('tenant_id', tenant('id'))
                    ->whereDate('created_at', today())->count(),
        'this_week' => TenantContact::where('tenant_id', tenant('id'))
                        ->where('created_at', '>=', now()->startOfWeek())->count(),
        'this_month' => TenantContact::where('tenant_id', tenant('id'))
                         ->where('created_at', '>=', now()->startOfMonth())->count(),
    ];
    
    return view('tenant.contacts.index', compact('contacts', 'stats'));
}
}