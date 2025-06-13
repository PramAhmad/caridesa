<x-layouts.app>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Log Details</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/logs">System Logs</a>
                        </li>
                        <li class="breadcrumb-item active">Log #{{ $log->id }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Activity Log Entry #{{ $log->id }}</h5>
                    <a href="{{ url('/logs') }}" class="btn btn-outline-primary">
                        <i class="fa fa-arrow-left me-1"></i> Back to Logs
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card border">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Log Information</h6>
                            </div>
                            <div class="card-body">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td width="140"><strong>Log ID:</strong></td>
                                            <td>{{ $log->id }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Table:</strong></td>
                                            <td><span class="badge bg-light-primary">{{ $log->log_name }}</span></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Event:</strong></td>
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
                                        </tr>
                                        <tr>
                                            <td><strong>Subject ID:</strong></td>
                                            <td>{{ $log->subject_id ?? 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Subject Type:</strong></td>
                                            <td>{{ $log->subject_type ? class_basename($log->subject_type) : 'N/A' }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Date & Time:</strong></td>
                                            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="card border">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">User Information</h6>
                            </div>
                            <div class="card-body">
                                @if($log->causer)
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar avatar-md me-3">
                                        <img src="{{ asset('tenant/images/user/default-avatar.png') }}" alt="User" class="rounded-circle">
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $log->causer->name }}</h6>
                                        <p class="text-muted mb-0">{{ $log->causer->email }}</p>
                                    </div>
                                </div>
                                
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td width="140"><strong>User ID:</strong></td>
                                            <td>{{ $log->causer->id }}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Role:</strong></td>
                                            <td>
                                                @if($log->causer->roles->isNotEmpty())
                                                    @foreach($log->causer->roles as $role)
                                                        <span class="badge bg-light-secondary">{{ $role->name }}</span>
                                                    @endforeach
                                                @else
                                                    <span class="text-muted">No roles assigned</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>IP Address:</strong></td>
                                            <td>{{ $log->properties['ip'] ?? 'N/A' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                @else
                                <div class="text-center py-3">
                                    <i class="fa fa-robot fa-3x text-muted mb-3"></i>
                                    <h5>System Action</h5>
                                    <p class="text-muted">This action was performed automatically by the system.</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-12">
                        <div class="card border">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Changed Data</h6>
                            </div>
                            <div class="card-body">
                                @if($log->description == 'created')
                                    <h6 class="text-success mb-3">New Record Created</h6>
                                    
                                    @if($log->properties->has('attributes'))
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Field</th>
                                                        <th>Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($log->properties['attributes'] as $field => $value)
                                                    <tr>
                                                        <td width="200"><strong>{{ $field }}</strong></td>
                                                        <td>
                                                            @if(is_array($value))
                                                                <pre class="mb-0">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                                            @elseif(is_null($value))
                                                                <span class="text-muted">NULL</span>
                                                            @else
                                                                {{ $value }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            No detailed information available for this log entry.
                                        </div>
                                    @endif
                                    
                                @elseif($log->description == 'updated')
                                    <h6 class="text-info mb-3">Record Updated</h6>
                                    
                                    @if($log->properties->has('old') && $log->properties->has('attributes'))
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Field</th>
                                                        <th>Old Value</th>
                                                        <th>New Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($log->properties['attributes'] as $field => $newValue)
                                                        @if(array_key_exists($field, $log->properties['old']) && $log->properties['old'][$field] !== $newValue)
                                                        <tr>
                                                            <td width="200"><strong>{{ $field }}</strong></td>
                                                            <td class="bg-light-danger">
                                                                @if(is_array($log->properties['old'][$field]))
                                                                    <pre class="mb-0">{{ json_encode($log->properties['old'][$field], JSON_PRETTY_PRINT) }}</pre>
                                                                @elseif(is_null($log->properties['old'][$field]))
                                                                    <span class="text-muted">NULL</span>
                                                                @else
                                                                    {{ $log->properties['old'][$field] }}
                                                                @endif
                                                            </td>
                                                            <td class="bg-light-success">
                                                                @if(is_array($newValue))
                                                                    <pre class="mb-0">{{ json_encode($newValue, JSON_PRETTY_PRINT) }}</pre>
                                                                @elseif(is_null($newValue))
                                                                    <span class="text-muted">NULL</span>
                                                                @else
                                                                    {{ $newValue }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            No detailed change information available for this log entry.
                                        </div>
                                    @endif
                                    
                                @elseif($log->description == 'deleted')
                                    <h6 class="text-danger mb-3">Record Deleted</h6>
                                    
                                    @if($log->properties->has('old'))
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Field</th>
                                                        <th>Deleted Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($log->properties['old'] as $field => $value)
                                                    <tr>
                                                        <td width="200"><strong>{{ $field }}</strong></td>
                                                        <td>
                                                            @if(is_array($value))
                                                                <pre class="mb-0">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                                            @elseif(is_null($value))
                                                                <span class="text-muted">NULL</span>
                                                            @else
                                                                {{ $value }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            No detailed information available for this deleted record.
                                        </div>
                                    @endif
                                    
                                @else
                                    <div class="alert alert-info">
                                        <h6 class="alert-heading">{{ ucfirst($log->description) }}</h6>
                                        <p class="mb-0">Custom action performed on this record.</p>
                                    </div>
                                    
                                    @if($log->properties->count() > 0)
                                        <div class="table-responsive mt-3">
                                            <table class="table table-bordered">
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Property</th>
                                                        <th>Value</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($log->properties as $prop => $value)
                                                        @if(!in_array($prop, ['ip']))
                                                        <tr>
                                                            <td width="200"><strong>{{ $prop }}</strong></td>
                                                            <td>
                                                                @if(is_array($value) || is_object($value))
                                                                    <pre class="mb-0">{{ json_encode($value, JSON_PRETTY_PRINT) }}</pre>
                                                                @elseif(is_null($value))
                                                                    <span class="text-muted">NULL</span>
                                                                @else
                                                                    {{ $value }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>