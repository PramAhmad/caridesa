<!-- Page Sidebar Start-->
<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper">
            <a href="/" class="logo-link">
                <img class="img-fluid" src="{{ asset('tenant/images/logo/ddap-logo-white.webp') }}" alt="" style="max-height: 40px"/>
            </a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar">
                <i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
            </div>
        </div>
        <div class="logo-icon-wrapper">
            <a href="/" class="logo-icon-link">
                <img class="img-fluid" src="{{ asset('tenant/images/logo/ddap-logo-icon.webp') }}" alt="" style="max-height: 40px" />
            </a>
        </div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span>
                            <i class="fa fa-angle-right ps-2" aria-hidden="true"></i>
                        </div>
                    </li>
                    <li class="sidebar-main-title p-0"></li>
                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6>Pinned</h6>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6>Menu</h6>
                        </div>
                    </li>

                    {{-- Dashboard - Visible to anyone with view-dashboard permission --}}
                    @can('view-dashboard')
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="">
                            <svg class="stroke-icon">
                                <use href="{{ asset('tenant/svg/icon-sprite.svg') }}#stroke-home"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('tenant/svg/icon-sprite.svg') }}#fill-home"></use>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    @endcan
                    
                    {{-- User Management Menu - Only visible to users with specific permissions --}}
                    @if(auth()->user()->canAny(['view-users', 'view-roles', 'view-permissions']))
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"> </i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('tenant/svg/icon-sprite.svg') }}#stroke-user"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('tenant/svg/icon-sprite.svg') }}#fill-user"></use>
                            </svg>
                            <span>User Management</span>
                        </a>
                        <ul class="sidebar-submenu">
                            @can('view-users')
                            <li class="text-sm">
                                <a href="/users">Users</a>
                            </li>
                            @endcan
                            
                            @can('view-roles')
                            <li>
                                <a href="/roles">Roles</a>
                            </li>
                            @endcan
                            
                            @can('view-permissions')
                            <li>
                                <a href="/permissions">Permissions</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endif
                    
                    {{-- Reports section - Only visible to users with report permissions --}}
                    @if(auth()->user()->canAny(['view-reports', 'generate-reports', 'export-reports']))
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"> </i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('tenant/svg/icon-sprite.svg') }}#stroke-chart"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('tenant/svg/icon-sprite.svg') }}#fill-chart"></use>
                            </svg>
                            <span>Reports</span>
                        </a>
                        <ul class="sidebar-submenu">
                            @can('view-reports')
                            <li>
                                <a href="">View Reports</a>
                            </li>
                            @endcan
                            
                            @can('generate-reports')
                            <li>
                                <a href="">Generate Report</a>
                            </li>
                            @endcan
                            
                            @can('export-reports')
                            <li>
                                <a href="">Export Reports</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endif
                    
                    {{-- System Settings - Only for users with system management permissions --}}
                    @can('manage-system-settings')
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"> </i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg class="stroke-icon">
                                <use href="{{ asset('tenant/svg/icon-sprite.svg') }}#stroke-setting"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('tenant/svg/icon-sprite.svg') }}#fill-setting"></use>
                            </svg>
                            <span>System Settings</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="">General Settings</a>
                            </li>
                            <li>
                                <a href="">Security Settings</a>
                            </li>
                            @can('manage-backups')
                            <li>
                                <a href="">Backups</a>
                            </li>
                            @endcan
                            @can('view-logs')
                            <li>
                                <a href="">System Logs</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                    
                    {{-- Profile - Always visible to authenticated users --}}
                    @can('update-profile')
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a href="" class="sidebar-link sidebar-title link-nav">
                            <svg class="stroke-icon">
                                <use href="{{ asset('tenant/svg/icon-sprite.svg') }}#stroke-user"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('tenant/svg/icon-sprite.svg') }}#fill-user"></use>
                            </svg>
                            <span>Profile</span>
                        </a>
                    </li>
                    @endcan
                    
                    {{-- Logout link - Always visible to authenticated users --}}
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="#" 
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <svg class="stroke-icon">
                                <use href="{{ asset('tenant/svg/icon-sprite.svg') }}#stroke-log-out"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('tenant/svg/icon-sprite.svg') }}#fill-log-out"></use>
                            </svg>
                            <span>Logout</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<!-- Page Sidebar Ends-->
