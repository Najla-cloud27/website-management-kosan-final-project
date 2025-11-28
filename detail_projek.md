````markdown
# 📝 Perancangan Aplikasi: Web App Management Kosan
**Nama Aplikasi:** `Kosan DiriQ by Najla`
**Versi Dokumen:** 1.0
**Tanggal:** 15 November 2025

---

## 1. 🚀 Ringkasan Proyek

Dokumen ini menjabarkan perancangan teknis untuk **Kosan DiriQ by Najla**, sebuah aplikasi manajemen kosan berbasis web. Aplikasi ini bertujuan untuk mendigitalkan dan menyederhanakan proses administrasi antara pemilik kosan (Admin) dan penyewa (Tenant).

### 1.1. 🛠️ Teknologi Utama
* **Backend Framework:** Laravel 12
* **Frontend Framework:** Livewire (v3+)
* **UI Framework:** Bootstrap 5.3+
* **Database:** MySQL / MariaDB
* **Paket Tambahan (Saran):**
    * `laravel/breeze` atau `laravel/jetstream`: Untuk autentikasi dasar.
    * `maatwebsite/excel`: Untuk fitur ekspor Excel.
    * `spatie/laravel-medialibrary`: Untuk manajemen unggah file (opsional, tapi disarankan).

---

## 2. 🗄️ Struktur Database (Schema)

Berikut adalah skema database SQL yang telah dimodifikasi sesuai permintaan, di mana setiap nama kolom diakhiri dengan `_{nama_tabel}`.

```sql
/* --- Tabel Utama: users --- */
CREATE TABLE `users` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) UNIQUE NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255),
  `nik` varchar(255) NOT NULL,
  `role` ENUM ('pemilik', 'penyewa') NOT NULL DEFAULT 'penyewa',
  `avatar_url` varchar(255),
  `remember_token` varchar(255),
  `created_at` timestamp NOT NULL DEFAULT (now()),
  `updated_at` timestamp NOT NULL DEFAULT (now())
);

/* --- Tabel Data Kamar: rooms --- */
CREATE TABLE `rooms` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `slug` varchar(255),
  `price` decimal(10,2) NOT NULL,
  `size` varchar(50),
  `status` ENUM ('tersedia', 'terisi', 'pemeliharaan', 'sudah_dipesan') NOT NULL DEFAULT 'tersedia',
  `fasilitas` text,
  `stok` ENUM ('tersedia', 'tidak_tersedia') NOT NULL DEFAULT 'tersedia',
  `main_image_url` varchar(255),
  `icon_svg` text,
  `created_at` timestamp NOT NULL DEFAULT (now()),
  `updated_at` timestamp NOT NULL DEFAULT (now())
);

/* --- Tabel Gambar Kamar (Galeri): room --- */
CREATE TABLE `room` (
  `id_room` int PRIMARY KEY AUTO_INCREMENT,
  `room_id_room` int NOT NULL,
  `image_url_room` varchar(255) NOT NULL,
  `created_at_room` timestamp NOT NULL DEFAULT (now())
);

/* --- Tabel Booking: bookings --- */
CREATE TABLE `bookings` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `room_id` int NOT NULL,
  `booking_code` varchar(255) UNIQUE NOT NULL,
  `duration_in_months` int DEFAULT 1,
  `selesai_booking` timestamp,
  `planned_check_in_date` timestamp,
  `status` ENUM ('pembayaran_tertunda', 'dikonfirmasi', 'selesai', 'dibatalkan') NOT NULL DEFAULT 'pembayaran_tertunda',
  `created_at` timestamp NOT NULL DEFAULT (now()),
  `updated_at` timestamp NOT NULL DEFAULT (now())
);

/* --- Tabel Tagihan: bills --- */
CREATE TABLE `bills` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `booking_id` int,
  `bill_code` varchar(255) UNIQUE NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255),
  `payment_gateaway` varchar(255),
  `status` ENUM ('belum_dibayar', 'verifikasi_tertunda', 'dibayar', 'terlambat') NOT NULL DEFAULT 'belum_dibayar',
  `created_at` timestamp NOT NULL DEFAULT (now()),
  `updated_at` timestamp NOT NULL DEFAULT (now())
);

/* --- Tabel Bukti Bayar: payment_proofs --- */
CREATE TABLE `payment_proofs` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `bill_id` int NOT NULL,
  `payment_proof_url` varchar(255) NOT NULL,
  `status` ENUM ('tertunda', 'terverifikasi', 'rejected') NOT NULL DEFAULT 'tertunda',
  `admin_notes` text,
  `created_at` timestamp NOT NULL DEFAULT (now()),
  `updated_at` timestamp NOT NULL DEFAULT (now())
);

/* --- Tabel Keluhan: complaints --- */
CREATE TABLE `complaints` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `room_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255),
  `status` ENUM ('dikirim', 'diproses', 'ditolak', 'selesai') NOT NULL DEFAULT 'dikirim',
  `created_at` timestamp NOT NULL DEFAULT (now()),
  `updated_at` timestamp NOT NULL DEFAULT (now())
);

/* --- Tabel Pengumuman: announcements --- */
CREATE TABLE `announcements` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `admin_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `publish_status` ENUM ('draf', 'diterbitkan') NOT NULL DEFAULT 'draf',
  `image_url` varchar(255),
  `created_at` timestamp NOT NULL DEFAULT (now()),
  `updated_at` timestamp NOT NULL DEFAULT (now())
);

/* --- Tabel Notifikasi: notifications --- */
CREATE TABLE `notifications` (
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT (now())
);

/* --- INDEXES --- */
CREATE INDEX `rooms_index_0` ON `rooms` (`name`);
CREATE INDEX `rooms_index_1` ON `rooms` (`price`);
CREATE INDEX `rooms_index_2` ON `rooms` (`status`);
CREATE INDEX `bills_index_3` ON `bills` (`user_id`);
CREATE INDEX `bills_index_4` ON `bills` (`booking_id`);
CREATE INDEX `bills_index_5` ON `bills` (`status`);
CREATE INDEX `payment_proofs_index_6` ON `payment_proofs` (`user_id`, `status`);
CREATE INDEX `payment_proofs_index_7` ON `payment_proofs` (`bill_id`);
CREATE INDEX `complaints_index_8` ON `complaints` (`user_id`);
CREATE INDEX `complaints_index_9` ON `complaints` (`room_id`);
CREATE INDEX `complaints_index_10` ON `complaints` (`status`);
CREATE INDEX `notifications_index_11` ON `notifications` (`user_id`);

/* --- FOREIGN KEYS --- */
ALTER TABLE `room` ADD FOREIGN KEY (`room_id_room`) REFERENCES `rooms` (`id`);
ALTER TABLE `bookings` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
ALTER TABLE `bookings` ADD FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
ALTER TABLE `bills` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
ALTER TABLE `bills` ADD FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`);
ALTER TABLE `payment_proofs` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
ALTER TABLE `payment_proofs` ADD FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`);
ALTER TABLE `complaints` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
ALTER TABLE `complaints` ADD FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
ALTER TABLE `announcements` ADD FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);
ALTER TABLE `notifications` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
````

-----

## 3\. 🗺️ Struktur Aplikasi & Model

Model Eloquent akan dibuat untuk setiap tabel guna memfasilitasi interaksi database.

  * `app/Models/User.php` (Menghubungkan ke tabel `users`)
  * `app/Models/Room.php` (Menghubungkan ke tabel `rooms`)
  * `app/Models/RoomImage.php` (Menghubungkan ke tabel `room`)
  * `app/Models/Booking.php` (Menghubungkan ke tabel `bookings`)
  * `app/Models/Bill.php` (Menghubungkan ke tabel `bills`)
  * `app/Models/PaymentProof.php` (Menghubungkan ke tabel `payment_proofs`)
  * `app/Models/Complaint.php` (Menghubungkan ke tabel `complaints`)
  * `app/Models/Announcement.php` (Menghubungkan ke tabel `announcements`)
  * `app/Models/Notification.php` (Menghubungkan ke tabel `notifications`)

**Catatan Penting:** Karena struktur tabel kustom (misal `id` alih-alih `id`), setiap Model perlu mendefinisikan Primary Key secara eksplisit:

```php
// Contoh di app/Models/User.php
protected $primaryKey = 'id';

// Contoh relasi di app/Models/Booking.php
public function user() {
    // foreignKey, ownerKey
    return $this->belongsTo(User::class, 'user_id', 'id');
}
```

-----

## 4\. 📊 Rincian Fitur Aplikasi (Implementasi Livewire)

Berikut adalah rincian untuk 10 fitur utama yang diminta.

### F1: Sistem Pelaporan Keluhan & Pelacakan Status

  * **Aktor:** Penyewa (Membuat), Pemilik (Mengelola)
  * **Deskripsi:** Penyewa melaporkan masalah fasilitas dan memantau progres perbaikannya.
  * **Komponen Livewire:**
      * `App\Livewire\Tenant\Complaint\CreateComplaint.php`: Form untuk penyewa membuat keluhan baru (judul, deskripsi, unggah gambar).
      * `App\Livewire\Tenant\Complaint\ComplaintList.php`: Daftar keluhan milik penyewa beserta status (`dikirim`, `diproses`, `selesai`).
      * `App\Livewire\Admin\Complaint\ManageComplaints.php`: Dasbor untuk pemilik melihat semua keluhan, memfilter, dan mengubah statusnya.

### F2: Sistem Tagihan & Konfirmasi Pembayaran

  * **Aktor:** Pemilik (Membuat Tagihan), Penyewa (Mengunggah Bukti)
  * **Deskripsi:** Membuat tagihan bulanan dan memungkinkan penyewa mengunggah bukti pembayaran.
  * **Komponen Livewire:**
      * `App\Livewire\Admin\Billing\GenerateBill.php`: Form untuk pemilik memilih penyewa/kamar dan generate tagihan baru (membuat record di tabel `bills`).
      * `App\Livewire\Admin\Billing\VerifyPayment.php`: Daftar bukti bayar (`payment_proofs`) yang berstatus 'tertunda'. Pemilik bisa 'terverifikasi' atau 'rejected'.
      * `App\Livewire\Tenant\Billing\UploadProof.php`: Komponen di halaman tagihan penyewa, berisi form unggah file (`payment_proof_url`) untuk tagihan spesifik.

### F3: Riwayat Tagihan & Pembayaran (Penyewa)

  * **Aktor:** Penyewa
  * **Deskripsi:** Penyewa melihat seluruh riwayat tagihan dan status pembayarannya.
  * **Komponen Livewire:**
      * `App\Livewire\Tenant\Billing\History.php`: Menampilkan tabel riwayat tagihan dari tabel `bills` yang berelasi dengan `user_id` milik penyewa yang login. Menampilkan status (`belum_dibayar`, `verifikasi_tertunda`, `dibayar`).

### F4: Papan Pengumuman Digital

  * **Aktor:** Pemilik (Membuat), Semua User (Melihat)
  * **Deskripsi:** Pengumuman penting yang langsung tampil di dasbor seluruh penyewa.
  * **Komponen Livewire:**
      * `App\Livewire\Admin\Announcement\Manager.php`: Fitur CRUD (Create, Read, Update, Delete) untuk mengelola `announcements`.
      * `App\Livewire\Tenant\Dashboard\AnnouncementDisplay.php`: Komponen yang diletakkan di dasbor penyewa, menampilkan 3-5 pengumuman terbaru yang statusnya `diterbitkan`.

### F5: Notifikasi Otomatis (Tagihan & Pengingat)

  * **Aktor:** Sistem
  * **Deskripsi:** Pengingat otomatis seperti jatuh tempo pembayaran.
  * **Implementasi (Non-Livewire):**
      * **Laravel Scheduler (Task Scheduling):** Dijalankan setiap hari (`app/Console/Kernel.php`).
      * **Command:** `app/Console/Commands/CheckDueDates.php`.
      * **Logika:** Command ini akan mencari `bills` yang statusnya `belum_dibayar` dan mendekati tanggal jatuh tempo (misal, H-3).
      * **Aksi:** Membuat record baru di tabel `notifications` untuk `user_id` yang bersangkutan.
  * **Komponen Livewire (Tampilan):**
      * `App\Livewire\Layout\NotificationBell.php`: Komponen kecil di navbar yang menampilkan jumlah notifikasi belum dibaca dan daftar notifikasi saat diklik.

### F6: Filter Kamar Tersedia

  * **Aktor:** Publik / Calon Penyewa
  * **Deskripsi:** Mencari kamar berdasarkan kriteria seperti harga dan fasilitas.
  * **Komponen Livewire:**
      * `App\Livewire\Public\RoomCatalog.php`: Halaman katalog kamar.
      * **Properti:** `$minPrice`, `$maxPrice`, `$fasilitas`.
      * **Metode `render()`:** Akan melakukan query ke model `Room` menggunakan `where('status', 'tersedia')`, `whereBetween('price', [$minPrice, $maxPrice])`, dan `where('fasilitas', 'like', '%...%')`. Menggunakan `#[Url]` untuk menjaga state filter di URL.

### F7: Ekspor Laporan Pembayaran (Admin)

  * **Aktor:** Pemilik
  * **Deskripsi:** Mengunduh rekap keuangan (siapa sudah bayar/belum) dalam format Excel.
  * **Implementasi:** Menggunakan `maatwebsite/excel`.
  * **Komponen Livewire:**
      * `App\Livewire\Admin\Report\PaymentExporter.php`: Komponen berisi filter (misal: rentang tanggal).
      * **Metode `export()`:** Akan memanggil Class Export (misal `App\Exports\PaymentsExport.php`) yang disiapkan oleh `maatwebsite/excel` untuk men-generate dan mengunduh file.

### F8: Ekspor Data Kamar ke Excel

  * **Aktor:** Pemilik
  * **Deskripsi:** Mengunduh seluruh data kamar (nama, harga, status, fasilitas) ke Excel.
  * **Implementasi:** Mirip F7, menggunakan `maatwebsite/excel`.
  * **Komponen Livewire:**
      * `App\Livewire\Admin\Report\RoomExporter.php`: Tombol sederhana di halaman manajemen kamar.
      * **Metode `exportRooms()`:** Memanggil `App\Exports\RoomsExport.php` untuk mengunduh data dari tabel `rooms`.

### F9: Pencarian Nama Kamar

  * **Aktor:** Pemilik, Penyewa
  * **Deskripsi:** Mencari kamar spesifik berdasarkan nama.
  * **Implementasi:** Diintegrasikan ke komponen yang sudah ada.
  * **Komponen Livewire:**
      * **Di `App\Livewire\Public\RoomCatalog.php`:** Tambahkan properti `#[Url] public $search = '';`. Query di-update dengan `where('name', 'like', '%'.$this->search.'%')`.
      * **Di `App\Livewire\Admin\Room\Manage.php`:** (Halaman admin untuk kelola kamar) Tambahkan input search yang sama.

### F10: Booking Kamar Online

  * **Aktor:** Publik / Calon Penyewa
  * **Deskripsi:** Penyewa dapat memesan kamar yang tersedia langsung dari website.
  * **Komponen Livewire:**
      * `App\Livewire\Public\BookingForm.php`: Ditampilkan di halaman detail kamar.
      * **Properti:** `roomId`, `checkInDate`, `duration`.
      * **Metode `submitBooking()`:**
        1.  Validasi data.
        2.  Membuat record baru di tabel `bookings` dengan `status = 'pembayaran_tertunda'`.
        3.  Membuat record tagihan pertama di tabel `bills` (untuk DP atau pembayaran bulan pertama).
        4.  Mengubah `status` di tabel `rooms` menjadi `booked`.
        5.  Redirect ke halaman "Menunggu Pembayaran" / "Detail Tagihan".

-----

## 5\. 🛣️ Struktur Rute (Contoh `routes/web.php`)

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Public\RoomCatalog;
use App\Livewire\Public\RoomDetail;
use App\Livewire\Tenant\Dashboard as TenantDashboard;
use App\Livewire\Tenant\Billing\History as TenantBillingHistory;
use App\Livewire\Tenant\Complaint\ComplaintList;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Room\ManageRooms;
use App\Livewire\Admin\Billing\ManageBilling;
use App\Livewire\Admin\Complaint\ManageComplaints;

/*
|--------------------------------------------------------------------------
| Rute Publik
|--------------------------------------------------------------------------
*/
Route::get('/', RoomCatalog::class)->name('home');
Route::get('/rooms', RoomCatalog::class)->name('rooms.index');
Route::get('/rooms/{slug}', RoomDetail::class)->name('rooms.show'); // Akan memuat F10 (Booking)

/*
|--------------------------------------------------------------------------
| Rute Autentikasi (Penyewa & Pemilik)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // --- Rute Khusus Penyewa (Role: 'penyewa') ---
    Route::middleware(['role:penyewa'])->prefix('my-account')->name('tenant.')->group(function () {
        Route::get('/dashboard', TenantDashboard::class)->name('dashboard'); // Menampilkan F4
        Route::get('/billing', TenantBillingHistory::class)->name('billing.history'); // Menampilkan F2, F3
        Route::get('/complaints', ComplaintList::class)->name('complaints.index'); // Menampilkan F1
    });

    // --- Rute Khusus Pemilik (Role: 'pemilik') ---
    Route::middleware(['role:pemilik'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
        Route::get('/rooms', ManageRooms::class)->name('rooms.manage'); // Mengelola kamar, ada F8, F9
        Route::get('/billing', ManageBilling::class)->name('billing.manage'); // Mengelola tagihan, F2
        Route::get('/complaints', ManageComplaints::class)->name('complaints.manage'); // Mengelola F1
        // Rute untuk F7 (Laporan) bisa ditambahkan di sini
    });
});

// Load rute autentikasi Breeze/Jetstream
require __DIR__.'/auth.php';

```

```
```