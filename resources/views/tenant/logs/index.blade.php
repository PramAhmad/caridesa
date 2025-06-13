<x-layouts.app>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>System Logs</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">System Logs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Activity Logs</h5>
                    <div>
                        <button type="button" class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#filterModal">
                            <i class="fa fa-filter me-1"></i> Filters
                        </button>
                        <a href="{{ url('/logs/export') }}" class="btn btn-outline-success me-2">
                            <i class="fa fa-download me-1"></i> Export
                        </a>
                        @can('manage-logs')
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#clearLogsModal">
                            <i class="fa fa-trash me-1"></i> Clear Logs
                        </button>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if(request()->anyFilled(['table', 'event', 'user', 'date_from', 'date_to']))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>Filters Applied:</strong>
                    @if(request('table')) <span class="badge bg-primary">Table: {{ request('table') }}</span> @endif
                    @if(request('event')) <span class="badge bg-primary">Event: {{ request('event') }}</span> @endif
                    @if(request('user')) <span class="badge bg-primary">User: {{ request('user') }}</span> @endif
                    @if(request('date_from')) <span class="badge bg-primary">From: {{ request('date_from') }}</span> @endif
                    @if(request('date_to')) <span class="badge bg-primary">To: {{ request('date_to') }}</span> @endif
                    
                    <a href="{{ url('/logs') }}" class="btn btn-sm btn-outline-primary ms-2">Clear Filters</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                
                @if($logs->isEmpty())
                <div class="text-center py-5">
                    <i class="fa fa-history fa-3x text-muted mb-3"></i>
                    <h5>No activity logs found</h5>
                    <p class="text-muted">There are no activity logs matching your criteria or the log is empty.</p>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date & Time</th>
                                <th>Table</th>
                                <th>Event</th>
                                <th>User</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->id }}</td>
                                <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <span class="badge bg-light-primary">{{ $log->log_name }}</span>
                                </td>
                                <td>
                                    @if($log->description == 'created')
                                        <span class="badge bg-success">Created</span>
                                    @elseif($log->description == 'updated')
                                        <span class="badge bg-info">Updated</span>
                                    @elseif($log->description == 'deleted')
                                        <span class="badge bg-danger">Deleted</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $log->description }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($log->causer)
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar avatar-xs">
                                                    <img src="{{ asset('tenant/images/user/default-avatar.png') }}" alt="User" class="rounded-circle">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-2">
                                                {{ $log->causer->name }}
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">System</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('/logs', $log->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-eye me-1"></i> View Details
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $logs->withQueryString()->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
    
    <!-- Filter Modal -->
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="filterModalLabel">Filter Activity Logs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/logs') }}" method="GET" id="filter-form">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Table</label>
                                <select class="form-select" name="table">
                                    <option value="">All Tables</option>
                                    @foreach($tables as $table)
                                        <option value="{{ $table }}" {{ request('table') == $table ? 'selected' : '' }}>
                                            {{ $table }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Event</label>
                                <select class="form-select" name="event">
                                    <option value="">All Events</option>
                                    <option value="created" {{ request('event') == 'created' ? 'selected' : '' }}>Created</option>
                                    <option value="updated" {{ request('event') == 'updated' ? 'selected' : '' }}>Updated</option>
                                    <option value="deleted" {{ request('event') == 'deleted' ? 'selected' : '' }}>Deleted</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">User</label>
                                <input type="text" class="form-control" name="user" value="{{ request('user') }}" placeholder="Search by name or email">
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date Range</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="date" class="form-control" name="date_from" value="{{ request('date_from') }}" placeholder="From">
                                    </div>
                                    <div class="col-6">
                                        <input type="date" class="form-control" name="date_to" value="{{ request('date_to') }}" placeholder="To">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('/logs') }}" class="btn btn-light">Clear Filters</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="filter-form" class="btn btn-primary">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Clear Logs Modal -->
    <div class="modal fade" id="clearLogsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Clear All Logs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert">
                        <h6 class="alert-heading">Warning: This action cannot be undone!</h6>
                        <p>You are about to delete all activity logs from the system. This will remove all historical record of changes made to the database.</p>
                    </div>
                    <p>Are you sure you want to clear all activity logs?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ url('/logs/clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes, Clear All Logs</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>