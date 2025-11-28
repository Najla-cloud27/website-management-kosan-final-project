<!-- header-top -->
<div class="header-top-section">
    <div class="container">
        <div class="header-top-wrapper bg-cover" style="background-image: url({{ asset('travo/img/header/3.png') }});">
            <ul class="top-left">
                <li>
                    <i class="fa-solid fa-envelope"></i>
                    <a href="mailto:info@kosandiriq.com">info@kosandiriq.com</a>
                </li>
                <li>
                    <i class="fa-solid fa-location-dot"></i>
                    Jl. Contoh No. 123, Jakarta, Indonesia
                </li>
            </ul>
            <ul class="top-right">
                <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
            </ul>
        </div>
    </div>
</div>

<!-- header-main -->
<div id="header-sticky" class="header-1">
    <div class="container">
        <div class="mega-menu-wrapper">
            <div class="header-main">
                <div class="logo">
                    <a href="{{ route('home') }}" class="header-logo">
                        <img src="{{ asset('travo/img/kosan-diriq.png') }}" alt="Kosan DiriQ Logo" style="max-height: 50px;">
                    </a>
                </div>
                <div class="header-right d-flex justify-content-end align-items-center">
                    <div class="mean__menu-wrapper">
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                <ul>
                                    <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                        <a href="{{ route('home') }}">Beranda</a>
                                    </li>
                                    <li class="{{ request()->routeIs('rooms.*') ? 'active' : '' }}">
                                        <a href="{{ route('rooms.index') }}">Kamar Tersedia</a>
                                    </li>
                                    <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                                        <a href="{{ route('about') }}">Tentang Kami</a>
                                    </li>
                                    <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                                        <a href="{{ route('contact') }}">Kontak</a>
                                    </li>
                                    
                                    @auth
                                        @if(auth()->user()->role === 'penyewa')
                                            <li>
                                                <a href="{{ route('tenant.dashboard') }}">Dashboard Saya</a>
                                            </li>
                                        @elseif(auth()->user()->role === 'pemilik')
                                            <li>
                                                <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                                            </li>
                                        @endif
                                    @endauth
                                </ul>
                            </nav>
                        </div>
                    </div>
                    
                    <a href="#0" class="search-trigger search-icon">
                        <i class="fa-regular fa-magnifying-glass"></i>
                    </a>
                    
                    <div class="header__hamburger my-auto">
                        <div class="sidebar__toggle">
                            <img src="{{ asset('travo/img/icon/bars.svg') }}" alt="Menu">
                        </div>
                    </div>
                    
                    @guest
                        <a href="{{ route('login') }}" class="theme-btn"> 
                            Login / Daftar
                            <i class="fa-sharp fa-regular fa-arrow-right"></i>
                        </a>
                    @else
                        <div class="dropdown">
                            <a href="#" class="theme-btn dropdown-toggle" data-bs-toggle="dropdown">
                                {{ auth()->user()->name }}
                                <i class="fa-solid fa-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if(auth()->user()->role === 'penyewa')
                                    <li><a class="dropdown-item" href="{{ route('tenant.dashboard') }}">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('tenant.billing.history') }}">Tagihan</a></li>
                                    <li><a class="dropdown-item" href="{{ route('tenant.complaints.index') }}">Keluhan</a></li>
                                @elseif(auth()->user()->role === 'pemilik')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Panel</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
