<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Livewire\Public\RoomCatalog;
use App\Livewire\Public\RoomDetail;
use App\Livewire\Tenant\Dashboard as TenantDashboard;
use App\Livewire\Tenant\Billing\History as TenantBillingHistory;
use App\Livewire\Tenant\Booking\MyBookings;
use App\Livewire\Tenant\Complaint\ComplaintList;
use App\Livewire\Tenant\Complaint\CreateComplaint;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Room\ManageRooms;
use App\Livewire\Admin\Billing\ManageBilling;
use App\Livewire\Admin\Booking\ManageBookings;
use App\Livewire\Admin\Complaint\ManageComplaints;
use App\Livewire\Admin\Announcement\Manager as AnnouncementManager;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('public.home');
})->name('home');

Route::get('/rooms', RoomCatalog::class)->name('rooms.index');
Route::get('/rooms/{slug}', RoomDetail::class)->name('rooms.show');

Route::get('/about', function () {
    return view('public.about');
})->name('about');

Route::get('/contact', function () {
    return view('public.contact');
})->name('contact');

Route::post('/contact', function (Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string|max:1000',
    ]);

    // Here you can add logic to save to database or send email
    // For now, we'll just flash a success message
    
    return redirect()->route('contact')->with('success', 'Terima kasih! Pesan Anda telah terkirim. Kami akan menghubungi Anda segera.');
})->name('contact.submit');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Tenant Routes (Penyewa)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:penyewa'])->prefix('my-account')->name('tenant.')->group(function () {
    Route::get('/dashboard', TenantDashboard::class)->name('dashboard');
    Route::get('/bookings', MyBookings::class)->name('bookings');
    Route::get('/billing', TenantBillingHistory::class)->name('billing.history');
    Route::get('/complaints', ComplaintList::class)->name('complaints.index');
    Route::get('/complaints/create', CreateComplaint::class)->name('complaints.create');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Pemilik)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pemilik'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/rooms', ManageRooms::class)->name('rooms.manage');
    Route::get('/bookings', ManageBookings::class)->name('bookings.manage');
    Route::get('/billing', ManageBilling::class)->name('billing.manage');
    Route::get('/complaints', ManageComplaints::class)->name('complaints.manage');
    Route::get('/announcements', AnnouncementManager::class)->name('announcements.manage');
});
