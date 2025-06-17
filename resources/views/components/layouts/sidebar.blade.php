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

                    {{-- Theme Management - Only for users with theme management permissions --}}
                    @can('manage-themes')
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"> </i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z" />
                            </svg>
                            <span>Pengaturan Tema</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="/admin/themes">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                    </svg>
                                    Kelola Tema
                                </a>
                            </li>
                            @can('create-themes')
                            <li>
                                <a href="/admin/themes/create">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Buat Tema
                                </a>
                            </li>
                            @endcan
                            @php
                                $activeTheme = \App\Models\Theme::where('is_active', true)->first();
                            @endphp
                            @if($activeTheme)
                            <li>
                                <a href="/admin/themes/{{ $activeTheme->id }}/edit-content">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                    Edit Konten
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endcan
                    <!-- product management -->
                    @can('manage-products')
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"> </i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-icon">
                                <path stroke-linecap="round" stroke-line
join="round" d="M3 12h18m-9-9v18m0-18a9 9 0 1 1 0 18 9 9 0 0 1 0-18z" />
                            </svg>
                            <span>Produk</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="/products">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none
" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18m-9-9v18m0-18a9 9 0 1 1 0 18 9 9 0 0 1 0-18z" />
                                    </svg>
                                    Kelola Produk
                                </a>
                            </li>
                            @can('create-products')
                            <li>
                                <a href="/products/create">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    Tambah Produk
                                </a>
                            </li>
                            @endcan
                            <!-- category product -->
                            <li>
                                <a href="/category-products">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke
="currentColor" class="w-4 h-4 me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18m-9-9v18m0-18a9 9 0 1 1 0 18 9 9 0 0 1 0-18z" />
                                    </svg>
                                    Kategori Produk
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    
                    {{-- System Settings - Only for users with system management permissions --}}
                    @can('manage-system-settings')
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"> </i>
                        <a class="sidebar-link sidebar-title" href="#">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                            </svg>

                            <span>Pengaturan Sistem</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="/settings/general">Pengaturan Umum</a>
                            </li>
                            <li>
                                <a href="/settings/security">Keamanan</a>
                            </li>
                            @can('manage-backups')
                            <li>
                                <a href="/settings/backups">Backups</a>
                            </li>
                            @endcan
                            @can('view-logs')
                            <li>
                                <a href="/logs">System Logs</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    <li class="sidebar-main-title">
                        <div>
                            <h6>Account</h6>
                        </div>
                    </li>

                    @can('update-profile')
                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a href="/profile" class="sidebar-link sidebar-title link-nav">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" stroke-opacity="0.8" class="stroke-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <span>Profile</span>
                        </a>
                    </li>
                    @endcan

                    <li class="sidebar-list">
                        <i class="fa fa-thumb-tack"></i>
                        <a class="sidebar-link sidebar-title link-nav" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="stroke-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m18.75 4.5-7.5 7.5 7.5 7.5m-6-15L5.25 12l7.5 7.5" />
                            </svg>
                            <span>Keluar</span>
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
