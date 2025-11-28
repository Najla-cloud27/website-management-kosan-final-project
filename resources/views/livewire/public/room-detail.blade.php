<div>
    <!-- Breadcrumb Section -->
    <section class="breadcrumb-wrapper fix bg-cover" style="background-image: url('{{ asset('travo/img/breadcrumb/breadcrumb.jpg') }}');">
        <div class="container">
            <div class="row">
                <div class="page-heading">
                    <h2>{{ $room->name }}</h2>
                    <ul class="breadcrumb-list">
                        <li><a href="{{ url('/') }}">Beranda</a></li>
                        <li><i class="fa-solid fa-chevrons-right"></i></li>
                        <li><a href="{{ route('rooms.index') }}">Kamar</a></li>
                        <li><i class="fa-solid fa-chevrons-right"></i></li>
                        <li class="active">{{ $room->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Room Details Section -->
    <section class="tour-section section-padding fix">
        <div class="container">
            <!-- Room Info -->
            <div class="row">
                <div class="col-12">
                    <div class="tour-wrapper">
                        <div class="activities-details-wrapper">
                            <!-- Image Gallery -->
                            <div class="room-image-container">
                                @if($room->main_image_url)
                                    {{-- Jika ada gambar utama, tampilkan gambar tersebut --}}
                                    <div class="single-image">
                                        <img src="{{ asset('storage/' . $room->main_image_url) }}" 
                                             alt="{{ $room->name }}"
                                             class="room-main-image">
                                    </div>
                                @else
                                    {{-- Jika tidak ada gambar, tampilkan 1 placeholder --}}
                                    <div class="single-image placeholder">
                                        <div class="placeholder-content">
                                            <i class="fa-solid fa-image"></i>
                                            <h4>{{ $room->name }}</h4>
                                            <p>Foto kamar akan segera tersedia</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                                <!-- Room Info -->
                                <div class="content">
                                    <h6>
                                        <i class="fa-solid fa-location-dot"></i> 
                                        Kosan DiriQ • 
                                        @if($room->status === 'tersedia')
                                            <span class="badge bg-success">Tersedia</span>
                                        @elseif($room->status === 'terisi')
                                            <span class="badge bg-danger">Terisi</span>
                                        @elseif($room->status === 'sudah_dipesan')
                                            <span class="badge bg-info">Sudah Dipesan</span>
                                        @elseif($room->status === 'pemeliharaan')
                                            <span class="badge bg-warning">Pemeliharaan</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucwords(str_replace('_', ' ', $room->status)) }}</span>
                                        @endif
                                    </h6>
                                    <h2>{{ $room->name }}</h2>
                                    <p class="mb-3">
                                        {{ $room->description ?? 'Kamar nyaman dengan fasilitas lengkap, cocok untuk mahasiswa atau pekerja. Lingkungan aman, tenang, dan strategis. Dilengkapi dengan berbagai fasilitas pendukung untuk kenyamanan Anda.' }}
                                    </p>
                                    <p>
                                        Kami menyediakan kamar kosan dengan standar kualitas terbaik dan harga yang terjangkau. Lokasi strategis, dekat dengan kampus, pusat perbelanjaan, dan akses transportasi umum. Keamanan 24 jam dan lingkungan yang bersih dan nyaman.
                                    </p>
                                </div>
                            </div>

                            <!-- Facilities -->
                            <div class="activities-list-item">
                                <h3>Fasilitas Kamar</h3>
                                @php
                                    // Fasilitas sudah otomatis di-cast ke array oleh model Room
                                    $roomFasilitas = is_array($room->fasilitas) ? $room->fasilitas : (is_string($room->fasilitas) ? json_decode($room->fasilitas, true) : []);
                                    
                                    $iconMap = [
                                        'AC' => 'fa-snowflake',
                                        'Kasur' => 'fa-bed',
                                        'Kasur Nyaman' => 'fa-bed',
                                        'Lemari' => 'fa-door-closed',
                                        'Lemari Pakaian' => 'fa-door-closed',
                                        'Kamar Mandi Dalam' => 'fa-shower',
                                        'Kamar Mandi Luar' => 'fa-bath',
                                        'Meja Belajar' => 'fa-desk',
                                        'Meja' => 'fa-table',
                                        'Kursi' => 'fa-chair',
                                        'WiFi' => 'fa-wifi',
                                        'Wifi' => 'fa-wifi',
                                        'WiFi Gratis' => 'fa-wifi',
                                        'TV' => 'fa-tv',
                                        'Kipas Angin' => 'fa-wind',
                                        'Lemari Es' => 'fa-temperature-low',
                                        'Jendela' => 'fa-window-maximize',
                                        'Kunci Pribadi' => 'fa-key',
                                    ];
                                    
                                    // Split into two columns
                                    $half = ceil(count($roomFasilitas) / 2);
                                    $firstColumn = array_slice($roomFasilitas, 0, $half);
                                    $secondColumn = array_slice($roomFasilitas, $half);
                                @endphp
                                
                                @if(is_array($roomFasilitas) && count($roomFasilitas) > 0)
                                <div class="activities-item">
                                    <ul class="activities-list">
                                        @foreach($firstColumn as $facility)
                                        <li>
                                            <i class="fa-solid {{ $iconMap[$facility] ?? 'fa-check' }}"></i>
                                            {{ $facility }}
                                        </li>
                                        @endforeach
                                    </ul>
                                    <ul class="activities-list">
                                        @foreach($secondColumn as $facility)
                                        <li>
                                            <i class="fa-solid {{ $iconMap[$facility] ?? 'fa-check' }}"></i>
                                            {{ $facility }}
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <div class="activities-item">
                                    <ul class="activities-list">
                                        <li><i class="fa-solid fa-bed"></i> Kasur Nyaman</li>
                                        <li><i class="fa-solid fa-door-closed"></i> Lemari Pakaian</li>
                                        <li><i class="fa-solid fa-desk"></i> Meja Belajar</li>
                                    </ul>
                                    <ul class="activities-list">
                                        <li><i class="fa-solid fa-snowflake"></i> AC</li>
                                        <li><i class="fa-solid fa-wifi"></i> WiFi Gratis</li>
                                        <li><i class="fa-solid fa-shower"></i> Kamar Mandi Dalam</li>
                                    </ul>
                                </div>
                                @endif
                            </div>

                            <!-- Room Specifications -->
                            <div class="activities-box-wrap">
                                <h3 class="spec-title">Spesifikasi Kamar</h3>
                                <div class="activities-box-area">
                                    <div class="activities-box-item">
                                        <div class="icon">
                                            <i class="fa-solid fa-expand"></i>
                                        </div>
                                        <div class="content">
                                            <span>Ukuran Kamar</span>
                                            <h6>{{ $room->size ?? '3x4 meter' }}</h6>
                                        </div>
                                    </div>
                                    <div class="activities-box-item">
                                        <div class="icon">
                                            <i class="fa-solid fa-money-bill-wave"></i>
                                        </div>
                                        <div class="content">
                                            <span>Harga/Bulan</span>
                                            <h6>Rp {{ number_format($room->price, 0, ',', '.') }}</h6>
                                        </div>
                                    </div>
                                    <div class="activities-box-item">
                                        <div class="icon">
                                            <i class="fa-solid fa-door-open"></i>
                                        </div>
                                        <div class="content">
                                            <span>Tipe Kamar</span>
                                            <h6>{{ $room->name }}</h6>
                                        </div>
                                    </div>
                                    <div class="activities-box-item">
                                        <div class="icon">
                                            <i class="fa-solid fa-check-circle"></i>
                                        </div>
                                        <div class="content">
                                            <span>Status</span>
                                            <h6>{{ ucfirst($room->status) }}</h6>
                                        </div>
                                    </div>
                                </div>
                                <h3 class="spec-title mt-4">Fasilitas Umum</h3>
                                <div class="activities-box-area mb-0">
                                    <div class="activities-box-item">
                                        <div class="icon">
                                            <i class="fa-solid fa-wifi"></i>
                                        </div>
                                        <div class="content">
                                            <span>Internet</span>
                                            <h6>WiFi Gratis</h6>
                                        </div>
                                    </div>
                                    <div class="activities-box-item">
                                        <div class="icon">
                                            <i class="fa-solid fa-bolt"></i>
                                        </div>
                                        <div class="content">
                                            <span>Listrik</span>
                                            <h6>Termasuk</h6>
                                        </div>
                                    </div>
                                    <div class="activities-box-item">
                                        <div class="icon">
                                            <i class="fa-solid fa-user-shield"></i>
                                        </div>
                                        <div class="content">
                                            <span>Keamanan</span>
                                            <h6>24 Jam</h6>
                                        </div>
                                    </div>
                                    <div class="activities-box-item">
                                        <div class="icon">
                                            <i class="fa-solid fa-droplet"></i>
                                        </div>
                                        <div class="content">
                                            <span>Air</span>
                                            <h6>PDAM</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /row -->

            <!-- Booking Form -->
            <div class="row mt-5">
                <div class="col-lg-6 mx-auto">
                    <div class="main-sidebar">
                        <div class="single-sidebar-widget">
                            <div class="wid-title">
                                <h3>Booking Kamar</h3>
                            </div>
                            <div class="booking-sidebar">
                                <!-- Flash Messages -->
                                @if (session()->has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check-circle me-2"></i>
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session()->has('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-exclamation-circle me-2"></i>
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session()->has('message'))
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-info-circle me-2"></i>
                                        {{ session('message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="booking-items">
                                    <div class="price-area">
                                        <h3>Rp {{ number_format($room->price, 0, ',', '.') }}</h3>
                                        <span>/Bulan</span>
                                    </div>
                                    
                                    @if($room->status === 'tersedia')
                                        @auth
                                        {{-- User sudah login, tampilkan form booking --}}
                                        <form wire:submit.prevent="submitBooking" class="booking-form">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama Lengkap</label>
                                                <input type="text" id="name" wire:model="name" class="form-control" placeholder="Masukkan nama">
                                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" id="email" wire:model="email" class="form-control" placeholder="email@example.com">
                                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">No. Telepon</label>
                                                <input type="tel" id="phone" wire:model="phone" class="form-control" placeholder="08xx-xxxx-xxxx">
                                                @error('phone') <span class="text-danger small">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="duration" class="form-label">Durasi Sewa</label>
                                                <select id="duration" wire:model="duration" class="form-select">
                                                    <option value="3">3 Bulan</option>
                                                    <option value="6">6 Bulan</option>
                                                    <option value="12">12 Bulan</option>
                                                </select>
                                                @error('duration') <span class="text-danger small">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="message" class="form-label">Catatan</label>
                                                <textarea id="message" wire:model="message" class="form-control" rows="3" placeholder="Pesan tambahan..."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100 py-2">
                                                <i class="fa-solid fa-paper-plane"></i> Kirim Booking
                                            </button>
                                        </form>
                                        @else
                                        {{-- User belum login --}}
                                        <div class="auth-required-box text-center p-4 bg-light rounded">
                                            <div class="auth-icon mb-3">
                                                <i class="fa-solid fa-lock fa-3x text-primary"></i>
                                            </div>
                                            <h5 class="fw-bold mb-2">Login Diperlukan</h5>
                                            <p class="text-muted mb-4">Silakan login atau daftar terlebih dahulu untuk melakukan booking kamar.</p>
                                            <div class="d-grid gap-2">
                                                <a href="{{ route('login') }}" class="btn btn-primary">
                                                    <i class="fa-solid fa-sign-in-alt"></i> Login
                                                </a>
                                                <a href="{{ route('register') }}" class="btn btn-outline-primary">
                                                    <i class="fa-solid fa-user-plus"></i> Daftar
                                                </a>
                                            </div>
                                        </div>
                                        @endauth
                                    @else
                                    <div class="alert alert-warning mb-0">
                                        <i class="fa-solid fa-exclamation-triangle"></i>
                                        Kamar sedang tidak tersedia.
                                    </div>
                                    @endif

                                    <div class="border-top pt-3 mt-4">
                                        <div class="d-flex align-items-center mb-3 p-3 bg-light rounded">
                                            <div class="me-3">
                                                <i class="fa-solid fa-phone fa-2x text-primary"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Hubungi Kami</small>
                                                <a href="tel:+6281234567890" class="text-decoration-none fw-bold">+62 812-3456-7890</a>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3 p-3 bg-light rounded">
                                            <div class="me-3">
                                                <i class="fa-solid fa-envelope fa-2x text-primary"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Email Kami</small>
                                                <a href="mailto:info@kosandiriq.com" class="text-decoration-none fw-bold">info@kosandiriq.com</a>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center p-3 bg-light rounded">
                                            <div class="me-3">
                                                <i class="fa-brands fa-whatsapp fa-2x text-success"></i>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">WhatsApp</small>
                                                <a href="https://wa.me/6281234567890" target="_blank" class="text-decoration-none fw-bold">Chat Sekarang</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /row -->

            <!-- Additional Info Section -->
            <div class="row mt-5">
                <div class="col-lg-8 mx-auto">
                    <div class="faq-items">
                        <h3 class="mb-4">Informasi Tambahan</h3>
                        <div class="accordion" id="accordion">
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                                        Persyaratan Sewa
                                    </button>
                                </h5>
                                <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <ul class="mb-3">
                                            <li>KTP atau identitas resmi</li>
                                            <li>Deposit 1 bulan (dikembalikan saat keluar)</li>
                                            <li>Minimal sewa 3 bulan</li>
                                            <li>Pembayaran di muka setiap bulan</li>
                                        </ul>
                                        <p>Semua persyaratan dapat dikonsultasikan langsung dengan pengelola.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                                        Peraturan Kosan
                                                </button>
                                            </h5>
                                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>Dilarang membawa tamu menginap tanpa izin</li>
                                            <li>Jam malam pukul 22:00 WIB</li>
                                            <li>Menjaga kebersihan dan ketertiban</li>
                                            <li>Dilarang merokok di dalam kamar</li>
                                            <li>Parkir tersedia untuk motor</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h5 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                                        Fasilitas Umum
                                    </button>
                                </h5>
                                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordion">
                                    <div class="accordion-body">
                                        <ul>
                                            <li>Dapur bersama</li>
                                            <li>Ruang tamu</li>
                                            <li>Tempat jemuran</li>
                                            <li>Parkir motor</li>
                                            <li>CCTV 24 jam</li>
                                            <li>Penjaga kosan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Location Map -->
                    <div class="map-area mt-5">
                        <h3 class="mb-4">Lokasi Kosan</h3>
                        <div class="google-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613!3d-6.1753924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sMonas!5e0!3m2!1sen!2sid!4v1234567890" style="border:0; width: 100%; height: 400px; border-radius: 10px;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div><!-- /col-lg-8 -->
            </div><!-- /row -->
        </div><!-- /container -->
    </section>
</div>

@push('scripts')
<script>
    // No carousel needed - single image display only
    console.log('Room detail page loaded');
</script>
@endpush

@push('styles')
<style>
    /* Room Image Container */
    .room-image-container {
        width: 100%;
        margin-bottom: 30px;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    
    .single-image {
        width: 100%;
        height: 500px;
        position: relative;
        overflow: hidden;
    }
    
    .room-main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .room-main-image:hover {
        transform: scale(1.05);
    }
    
    /* Placeholder Styling */
    .single-image.placeholder {
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .placeholder-content {
        text-align: center;
        color: white;
    }
    
    .placeholder-content i {
        font-size: 80px;
        margin-bottom: 20px;
        opacity: 0.9;
    }
    
    .placeholder-content h4 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
        color: white;
    }
    
    .placeholder-content p {
        font-size: 16px;
        opacity: 0.9;
        margin: 0;
    }
    
    /* Booking Sidebar Styling */
    .main-sidebar {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .single-sidebar-widget {
        padding: 0;
    }
    
    .wid-title {
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        padding: 20px 25px;
        margin: 0;
    }
    
    .wid-title h3 {
        color: white;
        margin: 0;
        font-size: 22px;
        font-weight: 700;
    }

    /* Auth Required Box Styling */
    .auth-required-box {
        text-align: center;
        padding: 40px 25px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 10px;
        margin: 20px 0;
    }

    .auth-icon {
        font-size: 60px;
        color: #2196F3;
        margin-bottom: 20px;
        opacity: 0.9;
    }

    .auth-required-box h4 {
        color: #1a1a1a;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .auth-required-box p {
        color: #6c757d;
        font-size: 14px;
        line-height: 1.6;
        margin-bottom: 25px;
    }

    .auth-buttons {
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .btn-auth {
        flex: 1;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s;
        text-align: center;
    }

    .btn-login {
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        color: white;
        border: none;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(33, 150, 243, 0.4);
        color: white;
    }

    .btn-register {
        background: #fff;
        color: #2196F3;
        border: 2px solid #2196F3;
    }

    .btn-register:hover {
        background: #2196F3;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(33, 150, 243, 0.3);
    }

    .booking-sidebar {
        padding: 0;
    }
    
    .booking-items {
        padding: 25px;
    }
    
    .booking-form .form-group {
        margin-bottom: 18px;
    }
    
    .booking-form label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #1a1a1a;
        font-size: 14px;
    }
    
    .booking-form .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e1e8ed;
        border-radius: 8px;
        transition: all 0.3s;
        font-size: 14px;
        background: #f8f9fa;
    }
    
    .booking-form .form-control:focus {
        border-color: #2196F3;
        outline: none;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
    }
    
    .booking-form .theme-btn {
        margin-top: 10px;
        padding: 14px 20px;
        font-size: 16px;
        font-weight: 600;
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        border: none;
        transition: all 0.3s;
    }
    
    .booking-form .theme-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(33, 150, 243, 0.4);
    }
    
    .booking-contact-list {
        border-top: 1px solid #e9ecef;
        padding-top: 20px;
        margin-top: 25px;
    }
    
    .booking-contact {
        display: flex;
        align-items: center;
        padding: 15px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 10px;
        margin-bottom: 12px;
        transition: all 0.3s;
        border: 1px solid #e9ecef;
    }
    
    .booking-contact:hover {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border-color: #2196F3;
        transform: translateX(5px);
    }
    
    .booking-contact .icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        flex-shrink: 0;
    }
    
    .booking-contact .icon i {
        color: #fff;
        font-size: 18px;
    }
    
    .booking-contact .content {
        flex: 1;
        min-width: 0;
    }
    
    .booking-contact .content span {
        display: block;
        font-size: 12px;
        color: #666;
        margin-bottom: 3px;
    }
    
    .booking-contact .content h6 {
        margin: 0;
        font-size: 14px;
        font-weight: 600;
    }
    
    .booking-contact .content h6 a {
        color: #1a1a1a;
        text-decoration: none;
        word-break: break-word;
    }
    
    .booking-contact .content h6 a:hover {
        color: #2196F3;
    }
    
    .price-area {
        text-align: center;
        padding: 25px 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 10px;
        margin-bottom: 25px;
        border: 2px dashed #2196F3;
    }
    
    .price-area h3 {
        color: #2196F3;
        font-size: 36px;
        margin: 0;
        font-weight: 800;
        line-height: 1;
    }
    
    .price-area span {
        color: #666;
        font-size: 16px;
        font-weight: 500;
        display: block;
        margin-top: 5px;
    }
    
    .activities-list li {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        background: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 10px;
        transition: all 0.3s;
        border-left: 3px solid #2196F3;
    }
    
    .activities-list li:hover {
        background: #e3f2fd;
        transform: translateX(5px);
    }
    
    .activities-list li i {
        color: #2196F3;
        margin-right: 12px;
        font-size: 18px;
        min-width: 20px;
        text-align: center;
    }
    
    .activities-item {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    
    @media (max-width: 768px) {
        .activities-item {
            grid-template-columns: 1fr;
        }
    }
    
    .activities-list-item h3 {
        color: #1a1a1a;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #2196F3;
    }
    
    /* Room Info Badges */
    .content h6 .badge {
        font-size: 13px;
        padding: 6px 12px;
        font-weight: 600;
    }
    
    /* Specifications Title */
    .spec-title {
        color: #1a1a1a;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #2196F3;
    }
    
    /* Specifications Grid */
    .activities-box-item {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #e9ecef;
        transition: all 0.3s;
    }
    
    .activities-box-item:hover {
        border-color: #2196F3;
        box-shadow: 0 5px 15px rgba(33, 150, 243, 0.2);
        transform: translateY(-3px);
    }
    
    .activities-box-item .icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
    }
    
    .activities-box-item .icon i {
        color: #fff;
        font-size: 24px;
    }
    
    .activities-box-item .content span {
        display: block;
        font-size: 13px;
        color: #666;
        margin-bottom: 5px;
    }
    
    .activities-box-item .content h6 {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }
    
    /* Accordion Improvements */
    .faq-items h3 {
        color: #1a1a1a;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid #2196F3;
    }
    
    .accordion-button {
        font-weight: 600;
        color: #1a1a1a;
        background: #f8f9fa;
    }
    
    .accordion-button:not(.collapsed) {
        color: #2196F3;
        background: #e3f2fd;
    }
    
    .accordion-body ul {
        list-style: none;
        padding: 0;
    }
    
    .accordion-body ul li {
        padding: 8px 0;
        padding-left: 25px;
        position: relative;
    }
    
    .accordion-body ul li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #2196F3;
        font-weight: bold;
    }

    /* Modal Styles */
    .booking-modal-backdrop {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease;
    }

    .booking-modal {
        background: white;
        border-radius: 15px;
        max-width: 500px;
        width: 90%;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        animation: slideUp 0.3s ease;
    }

    .booking-modal-header {
        padding: 25px 30px;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .booking-modal-header.success {
        background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
        color: white;
        border-radius: 15px 15px 0 0;
    }

    .booking-modal-header.error {
        background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
        color: white;
        border-radius: 15px 15px 0 0;
    }

    .booking-modal-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 30px;
    }

    .booking-modal-icon.success {
        background: rgba(76, 175, 80, 0.1);
        color: #4CAF50;
    }

    .booking-modal-icon.error {
        background: rgba(244, 67, 54, 0.1);
        color: #f44336;
    }

    .booking-modal-body {
        padding: 30px;
        text-align: center;
    }

    .booking-modal-body h3 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 15px;
        color: #1a1a1a;
    }

    .booking-modal-body p {
        font-size: 16px;
        color: #666;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .booking-modal-footer {
        padding: 20px 30px;
        border-top: 1px solid #e9ecef;
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .booking-modal-footer .btn {
        min-width: 120px;
        padding: 12px 25px;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

<!-- Booking Modal -->
@if($showModal)
<div class="booking-modal-backdrop" wire:click="closeModal">
    <div class="booking-modal" wire:click.stop>
        <div class="booking-modal-header {{ $modalType }}">
            <h5 class="mb-0" style="color: white;">
                @if($modalType === 'success')
                    <i class="fa-solid fa-check-circle me-2"></i>
                @else
                    <i class="fa-solid fa-exclamation-circle me-2"></i>
                @endif
                {{ $modalTitle }}
            </h5>
        </div>
        <div class="booking-modal-body">
            <div class="booking-modal-icon {{ $modalType }}">
                @if($modalType === 'success')
                    <i class="fa-solid fa-check"></i>
                @else
                    <i class="fa-solid fa-times"></i>
                @endif
            </div>
            <p>{!! $modalMessage !!}</p>
        </div>
        <div class="booking-modal-footer">
            @if($modalType === 'success')
                <button wire:click="closeModal" class="btn btn-secondary">
                    <i class="fa-solid fa-times me-1"></i> Tutup
                </button>
                <button wire:click="goToBookings" class="btn btn-primary">
                    <i class="fa-solid fa-calendar-check me-1"></i> Lihat Booking
                </button>
            @else
                <button wire:click="closeModal" class="btn btn-secondary">
                    <i class="fa-solid fa-times me-1"></i> Tutup
                </button>
            @endif
        </div>
    </div>
</div>
@endif
</div>

@push('scripts')
<script>
    // Auto redirect after successful booking
    document.addEventListener('livewire:init', () => {
        Livewire.on('booking-success', () => {
            setTimeout(() => {
                window.location.href = '{{ route("tenant.bookings") }}';
            }, 2500); // Redirect after 2.5 seconds
        });
    });
</script>
@endpush