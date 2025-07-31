<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --sidebar-gradient: linear-gradient(180deg, #1e3c72 0%, #2a5298 100%);
            --glassmorphism: rgba(255, 255, 255, 0.1);
            --card-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            --border-radius: 20px;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            --sidebar-width: 280px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #2c3e50;
            line-height: 1.6;
            overflow-x: hidden;
            min-height: 100vh;
        }

        /* Animated Background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%);
            z-index: -1;
            animation: bgFloat 20s ease-in-out infinite;
        }

        @keyframes bgFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Sidebar Styles */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: var(--sidebar-gradient);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            z-index: 1000;
            transition: var(--transition);
            overflow-y: auto;
            overflow-x: hidden;
        }

        #sidebar::-webkit-scrollbar {
            width: 6px;
        }

        #sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        #sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        #sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 30% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .sidebar-header {
            position: relative;
            z-index: 2;
            padding: 2rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .sidebar-header img {
            display: block;
            margin: 0 auto 1rem auto;
            width: 120px;
            height: 120px;
            border-radius: 60%;
            border: 3px solid rgba(255, 255, 255, 0.2);
            padding: 4px;
            background: rgba(255, 255, 255, 0.9);
            transition: var(--transition);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        }

        .sidebar-header img:hover {
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .sidebar-header h5 {
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            margin: 0;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            background: linear-gradient(45deg, #fff, #f0f0f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Navigation Styles */
        .sidebar-nav {
            position: relative;
            z-index: 2;
            padding: 1rem;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9);
            padding: 1rem 1.5rem;
            margin-bottom: 0.5rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            text-decoration: none;
            font-weight: 500;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(10px) scale(1.02);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            font-weight: 600;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border-left: 4px solid #fff;
            border-color: rgba(255, 255, 255, 0.4);
        }

        .nav-link i {
            font-size: 1.2rem;
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
            transition: var(--transition);
        }

        .nav-link:hover i {
            transform: scale(1.2);
        }

        /* Header Styles - FIXED */
        .main-header {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: 80px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            z-index: 999;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            transition: var(--transition);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .header-right {
            display: flex;
            align-items: center;
        }

        /* Main Content Styles */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            padding-top: 80px;
            min-height: 100vh;
            transition: var(--transition);
        }

        .main-content {
            padding: 2rem;
        }

        main {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: var(--border-radius);
            padding: 2.5rem;
            box-shadow: var(--card-shadow);
            min-height: calc(100vh - 160px);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        main::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
            border-radius: 20px 20px 0 0;
        }

        /* Submenu Styles */
        .submenu-link {
            padding: 0.8rem 1.5rem;
            margin-bottom: 0.3rem;
            font-size: 0.95rem;
            color: rgba(255, 255, 255, 0.8);
            transition: var(--transition);
            border-radius: 15px;
            display: block;
            text-decoration: none;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .submenu-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .submenu-link.active-submenu {
            font-weight: 600;
            color: white;
            background: rgba(255, 255, 255, 0.15);
            border-left: 3px solid #fff;
            border-color: rgba(255, 255, 255, 0.3);
        }

        .submenu-link i {
            margin-right: 0.5rem;
            width: 16px;
            text-align: center;
        }

        /* Collapse Transition */
        .collapse {
            transition: height 0.35s ease;
        }

        .collapsing {
            transition: height 0.35s ease;
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
            :root {
                --sidebar-width: 0px;
            }

            #sidebar {
                transform: translateX(-100%);
                width: 280px;
            }

            #sidebar.show {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .main-header {
                left: 0;
                padding: 0 1rem;
            }

            .main-content {
                padding: 1rem;
            }

            main {
                padding: 1.5rem;
                min-height: calc(100vh - 120px);
            }

            .mobile-toggle {
                display: block;
                background: none;
                border: none;
                color: #333;
                font-size: 1.5rem;
                cursor: pointer;
                padding: 0.5rem;
                border-radius: 10px;
                transition: var(--transition);
            }

            .mobile-toggle:hover {
                background: rgba(0, 0, 0, 0.1);
            }
        }

        @media (min-width: 769px) {
            .mobile-toggle {
                display: none;
            }
        }

        /* Scrollbar Styles */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-gradient);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-gradient);
        }

        /* Animation Classes */
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .slide-in {
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Loading Animation */
        .loading {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            overflow: hidden;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
        }

        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--hover-shadow);
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        /* Glassmorphism effect */
        .glass {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <nav id="sidebar" class="slide-in">
        <div class="sidebar-header">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="img-fluid">
            <h5>Sistem Program Rujuk Balik</h5>
        </div>
        
        <div class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-house"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->is('farmasis*') ? 'active' : '' }}" href="{{ route('farmasis.index') }}">
                        <i class="fa-solid fa-capsules"></i>
                        <span>Daftar FKTL</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->is('fktps*') ? 'active' : '' }}" href="{{ route('fktps.index') }}">
                        <i class="fa-solid fa-box"></i>
                        <span>Daftar FKTP</span>
                    </a>
                </li>
                <li class="nav-item">
                    @php
                        $isActiveSubmenu = str()->contains(request()->path(), 'apoteks') || str()->contains(request()->path(), 'obats');
                    @endphp

                    <a class="submenu-link {{ request()->is('apoteks*') ? 'active-submenu' : '' }}"
                                   href="{{ route('apoteks.index') }}">
                                   <i class="fa-solid fa-database"></i> Apotek & obat kosong
                    </a>
                </li>
                <li class="nav-item">
                    <a class="submenu-link {{ request()->is('obats/kosong*') ? 'active-submenu' : '' }}"
                        href="{{ route('obats.kosong') }}">
                        <i class="fa-solid fa-capsules"></i> Daftar Obat Kosong
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->is('rekrutmens*') ? 'active' : '' }}" href="{{ route('rekrutmens.index') }}">
                        <i class="fa-solid fa-user-nurse"></i>
                        <span>Peserta PRB</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->is('pic-prbs*') ? 'active' : '' }}" href="{{ route('pic-prbs.index') }}">
                        <i class="fa-solid fa-user-tie"></i>
                        <span>Daftar PIC RS/Klinik</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Header -->
    <header class="main-header glass">
        <div class="header-left">
            <button class="mobile-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            @isset($header)
                <div>
                    {{ $header }}
                </div>
            @endisset
        </div>
        
        <div class="header-right">
            @include('layouts.navigation')
        </div>
    </header>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <div class="main-content">
            <main class="fade-in">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mobileToggle = document.getElementById('mobileToggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            // Mobile toggle functionality
            mobileToggle?.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            });
            
            // Close sidebar when clicking overlay
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            });
            
            // Close sidebar on window resize to desktop
            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                }
            });
            
            // Navigation link animations (excluding submenu toggles)
            document.querySelectorAll('.nav-link:not([data-bs-toggle="collapse"])').forEach(link => {
                link.addEventListener('click', function(e) {
                    // Add loading state
                    const icon = this.querySelector('i');
                    if (icon && !icon.classList.contains('me-2')) {
                        const originalClass = icon.className;
                        icon.className = 'loading';
                        
                        // Restore icon after navigation
                        setTimeout(() => {
                            icon.className = originalClass;
                        }, 500);
                    }
                    
                    // Close mobile menu after clicking
                    if (window.innerWidth <= 768) {
                        setTimeout(() => {
                            sidebar.classList.remove('show');
                            sidebarOverlay.classList.remove('show');
                        }, 300);
                    }
                });
            });
            
            // Handle submenu link clicks for mobile
            document.querySelectorAll('.submenu-link').forEach(link => {
                link.addEventListener('click', function() {
                    // Close mobile menu after clicking submenu
                    if (window.innerWidth <= 768) {
                        setTimeout(() => {
                            sidebar.classList.remove('show');
                            sidebarOverlay.classList.remove('show');
                        }, 300);
                    }
                });
            });
            
            // Smooth scrolling enhancement
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
            
            // Add scroll effects
            let lastScrollTop = 0;
            const header = document.querySelector('.main-header');
            
            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                // Header hide/show on scroll
                if (scrollTop > lastScrollTop && scrollTop > 100) {
                    header.style.transform = 'translateY(-100%)';
                } else {
                    header.style.transform = 'translateY(0)';
                }
                
                lastScrollTop = scrollTop;
            });
            
            // Intersection Observer for fade-in animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                    }
                });
            }, observerOptions);
            
            // Observe all cards and main content
            document.querySelectorAll('.card, main').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>
</html>