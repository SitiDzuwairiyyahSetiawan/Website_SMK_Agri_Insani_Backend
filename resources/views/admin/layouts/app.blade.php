<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        Admin SMK Agri Insani - @yield('title', 'Dashboard')
    </title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <style>

        :root{

            --dark:#07140C;
            --green-dark:#0F2417;
            --green:#166534;
            --green-light:#22C55E;
            --green-soft:#BBF7D0;

            --white:#ffffff;
            --text:#E5F3EA;
            --muted:rgba(255,255,255,.65);

            --glass:
                rgba(255,255,255,.08);

            --border:
                rgba(255,255,255,.10);

            --shadow:
                0 20px 50px rgba(0,0,0,.25);

        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Inter',sans-serif;
        }

        body{

            background:
                linear-gradient(
                    135deg,
                    #07140C 0%,
                    #0F2417 35%,
                    #166534 100%
                );

            min-height:100vh;
            overflow-x:hidden;
            color:white;

            position:relative;

        }

        /* =========================
            BACKGROUND BLUR
        ========================= */

        body::before{
            content:'';

            position:fixed;
            width:400px;
            height:400px;

            background:#22C55E;

            filter:blur(140px);

            opacity:.12;

            top:-120px;
            right:-100px;

            z-index:-1;
        }

        body::after{
            content:'';

            position:fixed;
            width:320px;
            height:320px;

            background:#BBF7D0;

            filter:blur(140px);

            opacity:.08;

            bottom:-120px;
            left:-100px;

            z-index:-1;
        }

        /* =========================
            SIDEBAR
        ========================= */

        .sidebar{

            position:fixed;

            top:18px;
            left:18px;
            bottom:18px;

            width:280px;

            padding:18px;

            border-radius:32px;

            background:var(--glass);

            backdrop-filter:blur(20px);

            border:1px solid var(--border);

            box-shadow:var(--shadow);

            z-index:1000;

            overflow-y:auto;

            transition:.35s ease;

        }

        .sidebar::-webkit-scrollbar{
            width:5px;
        }

        .sidebar::-webkit-scrollbar-thumb{
            background:rgba(255,255,255,.15);
            border-radius:999px;
        }

        /* LOGO */

        .brand-box{

            display:flex;
            align-items:center;
            gap:14px;

            padding:10px 12px;

            margin-bottom:24px;

        }

        .brand-icon{

            width:55px;
            height:55px;

            border-radius:18px;

            display:flex;
            align-items:center;
            justify-content:center;

            background:
                linear-gradient(
                    135deg,
                    #22C55E,
                    #166534
                );

            box-shadow:
                0 10px 30px rgba(34,197,94,.35);

            flex-shrink:0;

        }

        .brand-icon i{
            font-size:22px;
            color:white;
        }

        .brand-title{
            font-size:16px;
            font-weight:800;
            line-height:1.3;
            color:white;
        }

        .brand-subtitle{
            font-size:12px;
            color:var(--muted);
            margin-top:2px;
        }

        /* NAV */

        .nav-title{

            font-size:11px;
            font-weight:700;

            color:rgba(255,255,255,.4);

            margin:
                22px 12px 10px;

            letter-spacing:.15em;

            text-transform:uppercase;

        }

        .sidebar .nav-link{

            height:54px;

            display:flex;
            align-items:center;

            padding:0 18px;

            border-radius:18px;

            color:rgba(255,255,255,.72);

            font-size:14px;
            font-weight:600;

            margin-bottom:8px;

            transition:.28s ease;

            border:1px solid transparent;

        }

        .sidebar .nav-link i{

            width:24px;

            margin-right:14px;

            font-size:15px;

        }

        .sidebar .nav-link:hover{

            background:rgba(255,255,255,.06);

            border-color:rgba(255,255,255,.05);

            color:white;

            transform:translateX(4px);

        }

        .sidebar .nav-link.active{

            background:
                linear-gradient(
                    135deg,
                    #16A34A,
                    #22C55E
                );

            color:white !important;

            box-shadow:
                0 15px 35px rgba(34,197,94,.25);

        }

        /* DROPDOWN */

        .sidebar-dropdown{
            margin-bottom:8px;
        }

        .sidebar-dropdown-btn{

            width:100%;
            height:54px;

            border:none;
            outline:none;

            background:transparent;

            color:rgba(255,255,255,.72);

            border-radius:18px;

            padding:0 18px;

            display:flex;
            align-items:center;
            justify-content:space-between;

            font-size:14px;
            font-weight:600;

            transition:.25s ease;

        }

        .sidebar-dropdown-btn:hover{

            background:rgba(255,255,255,.06);

            color:white;

        }

        .sidebar-dropdown-btn .left{

            display:flex;
            align-items:center;

        }

        .sidebar-dropdown-btn .left i{

            width:24px;
            margin-right:14px;

        }

        .chevron{
            transition:.3s ease;
            font-size:12px;
        }

        .sidebar-dropdown.open .chevron{
            transform:rotate(180deg);
        }

        .sidebar-dropdown-menu{

            display:none;

            padding:
                8px 0 4px 16px;

        }

        .sidebar-dropdown.open .sidebar-dropdown-menu{
            display:block;
        }

        .sidebar-dropdown-item{

            display:flex;
            align-items:center;

            height:46px;

            border-radius:14px;

            padding:0 16px;

            margin-bottom:6px;

            color:rgba(255,255,255,.68);

            font-size:13px;
            font-weight:500;

            text-decoration:none;

            transition:.25s ease;

        }

        .sidebar-dropdown-item i{

            width:20px;
            margin-right:12px;

        }

        .sidebar-dropdown-item:hover{

            background:rgba(255,255,255,.06);

            color:white;

            transform:translateX(4px);

        }

        .sidebar-dropdown-item.active{

            background:rgba(34,197,94,.18);

            color:white;

        }

        /* LOGOUT */

        .logout-btn{

            height:56px;

            border:none;

            border-radius:18px;

            background:
                linear-gradient(
                    135deg,
                    rgba(239,68,68,.18),
                    rgba(220,38,38,.18)
                );

            color:white;

            font-weight:700;

            transition:.3s ease;

        }

        .logout-btn:hover{

            transform:translateY(-3px);

            background:
                linear-gradient(
                    135deg,
                    rgba(239,68,68,.28),
                    rgba(220,38,38,.28)
                );

        }

        /* =========================
            TOPBAR
        ========================= */

        .topbar{

            position:fixed;

            top:18px;
            left:316px;
            right:18px;

            height:78px;

            border-radius:28px;

            background:var(--glass);

            backdrop-filter:blur(20px);

            border:1px solid var(--border);

            display:flex;
            align-items:center;
            justify-content:space-between;

            padding:0 28px;

            z-index:999;

            box-shadow:var(--shadow);

        }

        .topbar-title{

            color:white;

            font-size:24px;
            font-weight:800;

            margin:0;

        }

        .topbar-subtitle{

            color:var(--muted);

            font-size:13px;

            margin-top:4px;

        }

        .topbar-right{

            display:flex;
            align-items:center;
            gap:16px;

        }

        .admin-badge{

            display:flex;
            align-items:center;
            gap:12px;

            background:rgba(255,255,255,.06);

            border:1px solid rgba(255,255,255,.08);

            padding:10px 14px;

            border-radius:18px;

        }

        .admin-avatar{

            width:42px;
            height:42px;

            border-radius:14px;

            display:flex;
            align-items:center;
            justify-content:center;

            background:
                linear-gradient(
                    135deg,
                    #22C55E,
                    #166534
                );

            font-size:16px;

        }

        .admin-name{

            color:white;

            font-size:14px;
            font-weight:700;

            line-height:1.2;

        }

        .admin-role{

            color:var(--muted);

            font-size:11px;

            margin-top:2px;

        }

        /* =========================
            MAIN
        ========================= */

        .main-content{

        margin-left:316px;

        padding:
            120px 32px 32px;

        width:calc(100% - 316px);

        max-width:none;

        }

        /* KHUSUS HALAMAN FORM BESAR */
        .main-content .modern-card{
            width:100%;
        }

        .main-content .row{
            --bs-gutter-x: 2rem;
        }

        /* BREADCRUMB */

        .breadcrumb{

            background:transparent;

            padding:0;

            margin-bottom:22px;

        }

        .breadcrumb-item,
        .breadcrumb-item a{

            color:rgba(255,255,255,.6);

            font-size:13px;

            text-decoration:none;

        }

        .breadcrumb-item.active{
            color:white;
        }

        /* CARD */

        .card{

            background:rgba(255,255,255,.08);

            border:1px solid rgba(255,255,255,.08);

            backdrop-filter:blur(14px);

            border-radius:28px;

            box-shadow:var(--shadow);

            overflow:hidden;

        }

        /* ALERT */

        .alert{

            border:none;

            border-radius:20px;

            backdrop-filter:blur(10px);

        }

        .alert-success{

            background:rgba(34,197,94,.18);
            color:white;

        }

        .alert-danger{

            background:rgba(239,68,68,.18);
            color:white;

        }

        .alert-warning{

            background:rgba(245,158,11,.18);
            color:white;

        }

        /* BUTTON */

        .btn{

            border:none;

            border-radius:16px;

            font-weight:700;

            transition:.3s ease;

        }

        .btn-primary{

            background:
                linear-gradient(
                    135deg,
                    #16A34A,
                    #22C55E
                ) !important;

            box-shadow:
                0 12px 30px rgba(34,197,94,.25);

        }

        .btn-primary:hover{

            transform:translateY(-3px);

        }

        /* FORM */

        .form-control,
        .form-select{

            height:56px;

            background:rgba(255,255,255,.92);

            border:none !important;

            border-radius:18px !important;

            box-shadow:none !important;

        }

        .form-control:focus,
        .form-select:focus{

            background:white;

            box-shadow:
                0 0 0 5px rgba(34,197,94,.18) !important;

        }

        /* TABLE */

        .table{
            color:white;
        }

        .table thead th{

            border-bottom:
                1px solid rgba(255,255,255,.08);

            color:rgba(255,255,255,.7);

            font-size:13px;

        }

        .table td{

            border-color:
                rgba(255,255,255,.05);

        }

        /* MOBILE */

        .mobile-toggle{

            display:none;

            width:46px;
            height:46px;

            border:none;

            border-radius:14px;

            background:rgba(255,255,255,.08);

            color:white;

        }

        @media(max-width:991px){

            .sidebar{

                transform:translateX(-120%);

            }

            .sidebar.show{
                transform:translateX(0);
            }

            .topbar{

                left:18px;

                padding:0 18px;

            }

            .main-content{

            margin-left:0;

            width:100%;

            padding:110px 18px 18px;

           }

            .mobile-toggle{
                display:flex;
                align-items:center;
                justify-content:center;
            }

            .topbar-title{
                font-size:18px;
            }

        }

        @media(max-width:576px){

            .topbar{
                height:74px;
            }

            .main-content{
                width:100%;
                padding:
                    105px 16px 16px;
            }

            .sidebar{
                width:88%;
            }

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

    <!-- BRAND -->
    <div class="brand-box">

        <div class="brand-icon">
            <i class="fas fa-school"></i>
        </div>

        <div>
            <div class="brand-title">
                SMK Agri Insani
            </div>

            <div class="brand-subtitle">
                Admin Management
            </div>
        </div>

    </div>

    <!-- MENU -->
    <div class="nav-title">
        MAIN MENU
    </div>

    <ul class="nav flex-column">

        <!-- DASHBOARD -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
               href="{{ route('admin.dashboard') }}">
                <i class="fas fa-chart-pie"></i>
                Dashboard
            </a>
        </li>

        <!-- SLIDER -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.slider.*') ? 'active' : '' }}"
               href="{{ route('admin.slider.index') }}">
                <i class="fas fa-images"></i>
                Slider Hero
            </a>
        </li>

        <!-- PROFIL -->
        <li class="sidebar-dropdown" id="profilDropdown">

            <button class="sidebar-dropdown-btn"
                    onclick="toggleDropdown('profilDropdown')">

                <div class="left">
                    <i class="fas fa-building"></i>
                    Profil Sekolah
                </div>

                <i class="fas fa-chevron-down chevron"></i>

            </button>

            <div class="sidebar-dropdown-menu">

                <a class="sidebar-dropdown-item {{ request()->routeIs('admin.sejarah.*') ? 'active' : '' }}"
                   href="{{ route('admin.sejarah.index') }}">
                    <i class="fas fa-history"></i>
                    Sejarah
                </a>

                <a class="sidebar-dropdown-item {{ request()->routeIs('admin.visi-misi.*') ? 'active' : '' }}"
                   href="{{ route('admin.visi-misi.index') }}">
                    <i class="fas fa-eye"></i>
                    Visi & Misi
                </a>

                <a class="sidebar-dropdown-item {{ request()->routeIs('admin.sambutan.*') ? 'active' : '' }}"
                   href="{{ route('admin.sambutan.index') }}">
                    <i class="fas fa-user-tie"></i>
                    Sambutan
                </a>

            </div>

        </li>

        <!-- AKADEMIK -->
        <li class="sidebar-dropdown" id="akademikDropdown">

            <button class="sidebar-dropdown-btn"
                    onclick="toggleDropdown('akademikDropdown')">

                <div class="left">
                    <i class="fas fa-graduation-cap"></i>
                    Akademik
                </div>

                <i class="fas fa-chevron-down chevron"></i>

            </button>

            <div class="sidebar-dropdown-menu">

                <a class="sidebar-dropdown-item {{ request()->routeIs('admin.program-unggulan.*') ? 'active' : '' }}"
                   href="{{ route('admin.program-unggulan.index') }}">
                    <i class="fas fa-book-open"></i>
                    Program Unggulan
                </a>

                <a class="sidebar-dropdown-item {{ request()->routeIs('admin.ekstrakurikuler.*') ? 'active' : '' }}"
                   href="{{ route('admin.ekstrakurikuler.index') }}">
                    <i class="fas fa-futbol"></i>
                    Ekstrakurikuler
                </a>

            </div>

        </li>

        <!-- PUBLIKASI -->
        <li class="sidebar-dropdown" id="publikasiDropdown">

            <button class="sidebar-dropdown-btn"
                    onclick="toggleDropdown('publikasiDropdown')">

                <div class="left">
                    <i class="fas fa-newspaper"></i>
                    Publikasi
                </div>

                <i class="fas fa-chevron-down chevron"></i>

            </button>

            <div class="sidebar-dropdown-menu">

                <a class="sidebar-dropdown-item {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}"
                   href="{{ route('admin.berita.index') }}">
                    <i class="fas fa-newspaper"></i>
                    Berita
                </a>

                <a class="sidebar-dropdown-item {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}"
                   href="{{ route('admin.pengumuman.index') }}">
                    <i class="fas fa-bullhorn"></i>
                    Pengumuman
                </a>

            </div>

        </li>

        <!-- GALERI -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}"
               href="{{ route('admin.galeri.index') }}">
                <i class="fas fa-image"></i>
                Galeri
            </a>
        </li>

        <!-- KONTAK -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.kontak.*') ? 'active' : '' }}"
               href="{{ route('admin.kontak.index') }}">
                <i class="fas fa-envelope"></i>
                Kontak Masuk
            </a>
        </li>

        <!-- WHATSAPP -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.whatsapp-logs.*') ? 'active' : '' }}"
               href="{{ route('admin.whatsapp-logs.index') }}">
                <i class="fab fa-whatsapp"></i>
                Data WhatsApp
            </a>
        </li>

        <!-- PENDAFTARAN -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}"
               href="{{ route('admin.pendaftaran.index') }}">
                <i class="fas fa-file-alt"></i>
                Pendaftaran
            </a>
        </li>

    </ul>

    <!-- LOGOUT -->
    <div class="mt-4">

        <form method="POST"
              action="{{ route('logout') }}">

            @csrf

            <button type="submit"
                    class="logout-btn w-100">

                <i class="fas fa-right-from-bracket me-2"></i>

                Logout

            </button>

        </form>

    </div>

</div>

<!-- TOPBAR -->
<div class="topbar">

    <div class="d-flex align-items-center gap-3">

        <!-- MOBILE -->
        <button class="mobile-toggle"
                id="sidebarToggle">

            <i class="fas fa-bars"></i>

        </button>

        <div>

            <h1 class="topbar-title">
                @yield('title', 'Dashboard')
            </h1>
        </div>

    </div>

    <div class="topbar-right">

        <div class="admin-badge">

            <div class="admin-avatar">
                <i class="fas fa-user-shield"></i>
            </div>

            <div>

                <div class="admin-name">
                    {{ Auth::user()->name ?? 'Admin' }}
                </div>

                <div class="admin-role">
                    Administrator
                </div>

            </div>

        </div>

    </div>

</div>

<!-- MAIN -->
<div class="main-content">

    <!-- BREADCRUMB -->
    @hasSection('breadcrumb')

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">
                @yield('breadcrumb')
            </ol>

        </nav>

    @endif

    <!-- ALERT -->
    @if(session('success'))

        <div class="alert alert-success mb-4">

            <i class="fas fa-circle-check me-2"></i>

            {{ session('success') }}

        </div>

    @endif

    @if(session('error'))

        <div class="alert alert-danger mb-4">

            <i class="fas fa-circle-xmark me-2"></i>

            {{ session('error') }}

        </div>

    @endif

    @if(session('warning'))

        <div class="alert alert-warning mb-4">

            <i class="fas fa-triangle-exclamation me-2"></i>

            {{ session('warning') }}

        </div>

    @endif

    <!-- CONTENT -->
    @yield('content')

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

    // MOBILE SIDEBAR
    document
        .getElementById('sidebarToggle')
        ?.addEventListener('click',function(){

            document
                .getElementById('sidebar')
                .classList.toggle('show');

        });

    // CLOSE MOBILE
    document.addEventListener('click',function(e){

        const sidebar =
            document.getElementById('sidebar');

        const btn =
            document.getElementById('sidebarToggle');

        if(window.innerWidth <= 991){

            if(
                !sidebar.contains(e.target)
                &&
                !btn.contains(e.target)
            ){

                sidebar.classList.remove('show');

            }

        }

    });

    // DROPDOWN
    function toggleDropdown(id){

        const dropdown =
            document.getElementById(id);

        dropdown.classList.toggle('open');

    }

    // AUTO OPEN
    document.addEventListener('DOMContentLoaded',function(){

        const url = window.location.href;

        if(
            url.includes('/sejarah')
            ||
            url.includes('/visi-misi')
            ||
            url.includes('/sambutan')
        ){

            document
                .getElementById('profilDropdown')
                ?.classList.add('open');

        }

        if(
            url.includes('/program-unggulan')
            ||
            url.includes('/ekstrakurikuler')
        ){

            document
                .getElementById('akademikDropdown')
                ?.classList.add('open');

        }

        if(
            url.includes('/berita')
            ||
            url.includes('/pengumuman')
        ){

            document
                .getElementById('publikasiDropdown')
                ?.classList.add('open');

        }

    });

</script>

@stack('scripts')

</body>
</html>