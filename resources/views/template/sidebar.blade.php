<div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{ route('dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="90">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{ route('dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="90">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>
    
            <div class="dropdown sidebar-user m-1 rounded">
                <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-flex align-items-center gap-2">
                        <img class="rounded header-profile-user" src="assets/images/users/avatar-1.jpg" alt="Header Avatar">
                        <span class="text-start">
                            <span class="d-block fw-medium sidebar-user-name-text">{{ Auth::user()->name }}</span>
                            <span class="d-block fs-14 sidebar-user-name-sub-text"><i class="ri ri-circle-fill fs-10 text-success align-baseline"></i> <span class="align-middle">Online</span></span>
                        </span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <h6 class="dropdown-header">
                        Welcome, {{ Auth::user()->name }}!
                    </h6>                    
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="ri-shut-down-line align-middle me-1"></i> Logout
                    </a>                
                </div>
            </div>
            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('dashboard') }}" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li> <!-- end Dashboard Menu -->

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">Pemeriksaan</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarApps">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('predict.form') }}" class="nav-link" aria-expanded="false" aria-controls="sidebarCalendar" data-key="t-calender">
                                            Deteksi Dini Penyakit Jantung
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('education') }}" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class="ri-layout-3-line"></i> <span data-key="t-dashboards">Edukasi</span>
                            </a>
                        </li>

                        @if(Auth::user()->is_admin)
                        <li class="menu-title"><span>Admin</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}">
                                <i class="ri-settings-3-line"></i> <span>Admin Panel</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('admin.content.index') }}">
                                <i class="ri-file-edit-line"></i> <span>Kelola Konten CMS</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('admin.api-logs.index') }}">
                                <i class="ri-server-line"></i> <span>Log Request API</span>
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
            <div class="sidebar-background"></div>
        </div>