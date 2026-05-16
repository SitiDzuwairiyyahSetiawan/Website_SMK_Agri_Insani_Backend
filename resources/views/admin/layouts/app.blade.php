<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Admin SMK Agri Insani - @yield('title', 'Dashboard')</title>
    
    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --green-900: #14401E;
            --green-800: #1C5728;
            --green-700: #246934;
            --green-600: #2E7D41;
            --green-500: #3A9E52;
            --green-100: #DFFAE5;
            --cream: #FAFAF5;
            --text: #1A2510;
        }
        
        /* GLOBAL */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--cream);
            overflow-x: hidden;
        }
        
        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 250px;
            padding-top: 60px;
            background: linear-gradient(180deg, var(--green-900), var(--green-700));
            box-shadow: 4px 0 25px rgba(0,0,0,0.08);
            z-index: 100;
            transition: transform 0.3s ease-in-out;
            overflow-y: auto;
        }
        
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
        
        /* Nav Item */
        .sidebar .nav-item {
            margin: 2px 0;
        }
        
        .sidebar .nav-link {
            color: #C8DDBC;
            padding: 12px 18px;
            margin: 4px 10px;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link i {
            width: 24px;
            margin-right: 10px;
            font-size: 16px;
        }
        
        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.08);
            color: white;
            transform: translateX(4px);
        }
        
        .sidebar .nav-link.active {
            background: linear-gradient(90deg, var(--green-500), var(--green-600)) !important;
            color: white !important;
            box-shadow: 0 6px 18px rgba(58,158,82,0.4);
            position: relative;
        }
        
        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            height: 60%;
            width: 4px;
            background: #A7F3D0;
            border-radius: 4px;
        }
        
        /* CUSTOM DROPDOWN SIDEBAR - SAMA KAYAK TOPBAR */
        .sidebar .sidebar-dropdown {
            position: relative;
            margin: 4px 10px;
        }
        
        .sidebar .sidebar-dropdown-btn {
            background: transparent;
            border: none;
            width: 100%;
            text-align: left;
            color: #C8DDBC;
            padding: 12px 18px;
            border-radius: 10px;
            font-size: 14px;
            transition: all 0.25s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }
        
        .sidebar .sidebar-dropdown-btn i:first-child {
            width: 24px;
            margin-right: 10px;
            font-size: 16px;
        }
        
        .sidebar .sidebar-dropdown-btn .chevron {
            transition: transform 0.3s ease;
            font-size: 12px;
        }
        
        .sidebar .sidebar-dropdown-btn:hover {
            background: rgba(255,255,255,0.08);
            color: white;
        }
        
        .sidebar .sidebar-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #1a3a2a;
            border-radius: 10px;
            padding: 8px 0;
            margin-top: 5px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.2s ease;
            z-index: 1000;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            list-style: none;
        }
        
        .sidebar .sidebar-dropdown.open .sidebar-dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .sidebar .sidebar-dropdown-item {
            display: flex;
            align-items: center;
            padding: 8px 15px 8px 45px;
            color: #C8DDBC;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.2s ease;
        }
        
        .sidebar .sidebar-dropdown-item i {
            width: 20px;
            margin-right: 8px;
            font-size: 12px;
        }
        
        .sidebar .sidebar-dropdown-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            transform: translateX(4px);
        }
        
        .sidebar .sidebar-dropdown-item.active {
            background: linear-gradient(90deg, var(--green-500), var(--green-600)) !important;
            color: white !important;
        }
        
        /* Sidebar divider */
        .sidebar hr {
            margin: 20px 15px;
            border-color: rgba(255,255,255,0.1);
        }
        
        /* TOPBAR */
        .navbar {
            background: white !important;
            border-bottom: 1px solid #E2E8D8;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 12px 24px;
        }
        
        .navbar-brand {
            font-weight: 800;
            color: var(--green-700) !important;
            font-size: 1.25rem;
        }
        
        /* CONTENT */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            min-height: 100vh;
            transition: margin-left 0.3s ease;
        }
        
        /* BUTTON THEME */
        .btn-primary {
            background: linear-gradient(135deg, var(--green-500), var(--green-600)) !important;
            border: none !important;
            color: white !important;
            border-radius: 10px;
            font-weight: 600;
            padding: 8px 20px;
            box-shadow: 0 4px 12px rgba(46,125,65,0.25);
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--green-600), var(--green-700)) !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(46,125,65,0.35);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .btn-success {
            background-color: var(--green-500) !important;
            border: none !important;
        }
        
        .btn-outline-light {
            border-color: rgba(255,255,255,0.4);
            color: white;
            transition: all 0.2s ease;
        }
        
        .btn-outline-light:hover {
            background: white;
            color: var(--green-700);
            transform: translateY(-1px);
        }
        
        /* FORM */
        .form-control, .form-select {
            border-radius: 10px;
            border: 1px solid #e2e8d8;
            padding: 10px 14px;
            transition: all 0.2s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 3px rgba(46,125,65,0.15);
            outline: none;
        }
        
        /* CARD */
        .card {
            border-radius: 14px;
            border: none;
            box-shadow: 0 6px 20px rgba(0,0,0,0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .card:hover {
            box-shadow: 0 12px 30px rgba(0,0,0,0.1);
        }
        
        /* ALERT ANIMATIONS */
        .alert {
            animation: slideDown 0.3s ease-out;
            border-radius: 12px;
            border: none;
        }
        
        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        /* BREADCRUMB */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
        }
        
        .breadcrumb-item a {
            color: var(--green-600);
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .breadcrumb-item a:hover {
            color: var(--green-700);
            text-decoration: underline;
        }
        
        .breadcrumb-item.active {
            color: #6c757d;
        }
        
        /* TABLE */
        .table {
            vertical-align: middle;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(58,158,82,0.05);
        }
        
        /* PAGINATION */
        .pagination {
            margin-bottom: 0;
        }
        
        .page-link {
            color: var(--green-600);
            border-radius: 8px;
            margin: 0 3px;
        }
        
        .page-item.active .page-link {
            background: var(--green-600);
            border-color: var(--green-600);
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                padding: 20px 15px;
            }
            
            .navbar {
                padding: 10px 15px;
            }
        }
        
        /* UTILITY CLASSES */
        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--green-500), var(--green-600));
        }
        
        .text-gradient {
            background: linear-gradient(135deg, var(--green-500), var(--green-600));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* DELETE PAGE SPECIFIC */
        .delete-preview-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        
        .delete-preview-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #dc2626, #b91c1c) !important;
            border: none !important;
            transition: all 0.2s ease;
        }
        
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(220,38,38,0.3);
        }
    </style>
    
    @stack('styles')
</head>

<body>
    <script>
        window.apiBaseUrl = "{{ url('/api') }}";
    </script>

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" 
                   href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
  
            <!-- Slider Hero -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.slider.*') ? 'active' : '' }}" 
                   href="{{ route('admin.slider.index') }}">
                    <i class="fas fa-image"></i> Slider Hero
                </a>
            </li>
            
            <!-- PROFIL DROPDOWN -->
            <li class="sidebar-dropdown" id="profilDropdown">
                <button class="sidebar-dropdown-btn" onclick="toggleDropdown('profilDropdown')">
                    <div>
                        <i class="fas fa-building"></i> Profil Sekolah
                    </div>
                    <i class="fas fa-chevron-down chevron"></i>
                </button>
                <ul class="sidebar-dropdown-menu">
                    <li>
                        <a class="sidebar-dropdown-item {{ request()->routeIs('admin.sejarah.*') ? 'active' : '' }}" 
                        href="{{ route('admin.sejarah.index') }}">
                            <i class="fas fa-history"></i> Sejarah
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-dropdown-item {{ request()->routeIs('admin.visi-misi.*') ? 'active' : '' }}" 
                           href="{{ route('admin.visi-misi.index') }}">
                            <i class="fas fa-eye"></i> Visi & Misi
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-dropdown-item {{ request()->routeIs('admin.sambutan.*') ? 'active' : '' }}" 
                           href="{{ route('admin.sambutan.index') }}">
                            <i class="fas fa-user-tie"></i> Sambutan Kepsek
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- AKADEMIK DROPDOWN -->
            <li class="sidebar-dropdown" id="akademikDropdown">
                <button class="sidebar-dropdown-btn" onclick="toggleDropdown('akademikDropdown')">
                    <div>
                        <i class="fas fa-graduation-cap"></i> Akademik
                    </div>
                    <i class="fas fa-chevron-down chevron"></i>
                </button>
                <ul class="sidebar-dropdown-menu">
                    <li>
                        <a class="sidebar-dropdown-item {{ request()->routeIs('admin.program-unggulan.*') ? 'active' : '' }}" 
                           href="{{ route('admin.program-unggulan.index') }}">
                            <i class="fas fa-book"></i> Program Unggulan
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-dropdown-item {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'active' : '' }}" 
                           href="{{ route('admin.ekstrakurikuler.index') }}">
                            <i class="fas fa-futbol"></i> Ekstrakurikuler
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- PUBLIKASI DROPDOWN -->
            <li class="sidebar-dropdown" id="publikasiDropdown">
                <button class="sidebar-dropdown-btn" onclick="toggleDropdown('publikasiDropdown')">
                    <div>
                        <i class="fas fa-newspaper"></i> Publikasi
                    </div>
                    <i class="fas fa-chevron-down chevron"></i>
                </button>
                <ul class="sidebar-dropdown-menu">
                    <li>
                        <a class="sidebar-dropdown-item {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}" 
                           href="{{ route('admin.berita.index') }}">
                            <i class="fas fa-newspaper"></i> Berita
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-dropdown-item {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}" 
                           href="{{ route('admin.pengumuman.index') }}">
                            <i class="fas fa-bullhorn"></i> Pengumuman
                        </a>
                    </li>
                </ul>
            </li>
            
            <!-- Galeri -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}" 
                   href="{{ route('admin.galeri.index') }}">
                    <i class="fas fa-images"></i> Galeri
                </a>
            </li>
            
            <!-- Kontak Masuk -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}" 
                   href="{{ route('admin.kontak.index') }}">
                    <i class="fas fa-address-card"></i> Kontak Masuk
                </a>
            </li>

            <!-- Data WhatsApp -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.whatsapp-logs.*') ? 'active' : '' }}"
                   href="{{ route('admin.whatsapp-logs.index') }}">
                    <i class="fas fa-comment-dots"></i> Data WhatsApp
                </a>
            </li>
            
            <!-- Pendaftaran -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}" 
                   href="{{ route('admin.pendaftaran.index') }}">
                    <i class="fas fa-file-alt"></i> Pendaftaran
                </a>
            </li>
        </ul>
        
        <hr class="text-white my-3">
        
        <form method="POST" action="{{ route('logout') }}" class="px-3">
            @csrf
            <button type="submit" class="btn btn-outline-light w-100">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    </div>
</div>

<!-- TOPBAR -->
<nav class="navbar sticky-top">
    <div class="container-fluid">
        <button class="btn btn-link d-md-none text-dark p-0" id="sidebarToggle">
            <i class="fas fa-bars fa-lg"></i>
        </button>
        
        <span class="navbar-brand mx-auto mx-md-0">
            <i class="fas fa-school me-2"></i>
            SMK Agri Insani Admin
        </span>
        
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-1"></i>
                {{ Auth::user()->name ?? 'Admin' }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- MAIN CONTENT -->
<div class="main-content">
    
    <!-- BREADCRUMB -->
    @hasSection('breadcrumb')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                @yield('breadcrumb')
            </ol>
        </nav>
    @endif
    
    <!-- ALERT MESSAGES -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-times-circle me-2"></i>
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <!-- MAIN YIELD CONTENT -->
    @yield('content')
    
</div>

<!-- SCRIPTS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Sidebar Toggle untuk mobile
    document.getElementById('sidebarToggle')?.addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('show');
    });
    
    // Tutup sidebar saat klik di luar (mobile)
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        
        if (window.innerWidth <= 768) {
            if (!sidebar.contains(event.target) && !toggleBtn?.contains(event.target) && sidebar.classList.contains('show')) {
                sidebar.classList.remove('show');
            }
        }
    });
    
    // Auto close alert setelah 5 detik
    setTimeout(function() {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            const bsAlert = new bootstrap.Alert(alert);
            setTimeout(function() {
                bsAlert.close();
            }, 5000);
        });
    }, 1000);
    
    // Toggle dropdown function
    function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        const isOpen = dropdown.classList.contains('open');
        
        // Tutup semua dropdown lain
        document.querySelectorAll('.sidebar-dropdown').forEach(d => {
            if (d.id !== dropdownId) {
                d.classList.remove('open');
            }
        });
        
        // Toggle dropdown yang diklik
        if (!isOpen) {
            dropdown.classList.add('open');
        } else {
            dropdown.classList.remove('open');
        }
    }
    
    // Tutup dropdown ketika klik di luar
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.sidebar-dropdown')) {
            document.querySelectorAll('.sidebar-dropdown').forEach(dropdown => {
                dropdown.classList.remove('open');
            });
        }
    });
    
    // Buka dropdown otomatis jika route sedang aktif
    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = window.location.href;
        
        // Cek Profil menu
        if (currentUrl.includes('/sejarah') || currentUrl.includes('/visi-misi') || currentUrl.includes('/sambutan')) {
            document.getElementById('profilDropdown')?.classList.add('open');
        }
        
        // Cek Akademik menu
        if (currentUrl.includes('/program-unggulan') || currentUrl.includes('/ekstrakurikuler')) {
            document.getElementById('akademikDropdown')?.classList.add('open');
        }
        
        // Cek Publikasi menu
        if (currentUrl.includes('/berita') || currentUrl.includes('/pengumuman')) {
            document.getElementById('publikasiDropdown')?.classList.add('open');
        }
    });
</script>

@stack('scripts')

</body>
</html>