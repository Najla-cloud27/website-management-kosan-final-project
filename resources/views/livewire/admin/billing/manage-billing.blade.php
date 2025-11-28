<div>
    {{-- Page Title --}}
    @include('layouts.partials.page-title', [
        'title' => 'Manajemen Tagihan',
        'breadcrumbs' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Tagihan & Pembayaran']
        ]
    ])

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Kelola Tagihan & Pembayaran</h5>
        <button wire:click="exportPayments" class="btn btn-soft-success">
            <i data-lucide="file-spreadsheet" style="width: 16px; height: 16px;" class="me-1"></i> Export Excel
        </button>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Tab Navigation -->
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ $activeTab === 'bills' ? 'active' : '' }}" 
               wire:click="$set('activeTab', 'bills')" href="javascript:void(0)" style="cursor: pointer;">
                <i data-lucide="receipt" style="width: 16px; height: 16px;" class="me-1"></i> Semua Tagihan
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $activeTab === 'pending_proofs' ? 'active' : '' }}" 
               wire:click="$set('activeTab', 'pending_proofs')" href="javascript:void(0)" style="cursor: pointer;">
                <i data-lucide="clock" style="width: 16px; height: 16px;" class="me-1"></i> Verifikasi Pembayaran
            </a>
        </li>
    </ul>

    @if($activeTab === 'bills')
        <button wire:click="$toggle('showGenerateForm')" class="btn btn-soft-primary mb-3">
            <i data-lucide="plus-circle" style="width: 16px; height: 16px;" class="me-1"></i> Buat Tagihan Baru
        </button>

        @if($showGenerateForm)
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Buat Tagihan Baru</h5>
                    <form wire:submit.prevent="generateBill">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Pilih Penyewa</label>
                                <select wire:model="selectedUserId" class="form-select @error('selectedUserId') is-invalid @enderror">
                                    <option value="">-- Pilih --</option>
                                    @foreach($tenants as $tenant)
                                        <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                                    @endforeach
                                </select>
                                @error('selectedUserId') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Jumlah (Rp)</label>
                                <input type="text" wire:model="billAmount" data-rupiah class="form-control @error('billAmount') is-invalid @enderror" placeholder="Masukkan jumlah">
                                @error('billAmount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">&nbsp;</label>
                                <button type="submit" class="btn btn-soft-success w-100">
                                    <i data-lucide="zap" style="width: 16px; height: 16px;" class="me-1"></i> Generate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Penyewa</th>
                            <th>Jumlah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bills as $bill)
                            <tr>
                                <td>{{ $bill->bill_code }}</td>
                                <td>{{ $bill->user->name }}</td>
                                <td>Rp {{ number_format($bill->total_amount, 0, ',', '.') }}</td>
                                <td><span class="badge {{ status_badge_class($bill->status) }}">{{ format_status($bill->status) }}</span></td>
                                <td>
                                    <button wire:click="deleteBill({{ $bill->id }})" wire:confirm="Hapus tagihan ini?" class="btn btn-sm btn-soft-danger" title="Hapus">
                                        <i data-lucide="trash-2" style="width: 14px; height: 14px;"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">Belum ada tagihan</td></tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $bills->links() }}
            </div>
        </div>
    @endif

    @if($activeTab === 'pending_proofs')
        <div class="row">
            @forelse($pendingProofs as $proof)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        <div class="card-header bg-light">
                            <h6 class="mb-0">{{ $proof->bill->bill_code }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <small class="text-muted d-block">Penyewa</small>
                                <strong>{{ $proof->user->name }}</strong>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block">Jumlah Tagihan</small>
                                <h5 class="mb-0 text-primary">Rp {{ number_format($proof->bill->total_amount, 0, ',', '.') }}</h5>
                            </div>
                            <div class="mb-3">
                                <small class="text-muted d-block mb-2">Bukti Pembayaran</small>
                                @if($proof->payment_proof_url)
                                    <div class="border rounded p-2 text-center bg-light">
                                        <img src="{{ asset('storage/' . $proof->payment_proof_url) }}" 
                                             class="img-fluid rounded" 
                                             style="max-height: 250px; width: 100%; object-fit: contain; cursor: pointer;"
                                             onclick="window.open('{{ asset('storage/' . $proof->payment_proof_url) }}', '_blank')"
                                             alt="Bukti Pembayaran"
                                             onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'200\' height=\'200\'%3E%3Crect fill=\'%23ddd\' width=\'200\' height=\'200\'/%3E%3Ctext fill=\'%23999\' x=\'50%25\' y=\'50%25\' text-anchor=\'middle\' dy=\'.3em\'%3EGambar tidak ditemukan%3C/text%3E%3C/svg%3E';">
                                        <small class="text-muted d-block mt-2">Klik untuk memperbesar</small>
                                    </div>
                                @else
                                    <div class="alert alert-warning mb-0">
                                        <i data-lucide="alert-triangle" style="width: 16px; height: 16px;" class="me-1"></i>
                                        Bukti pembayaran tidak tersedia
                                    </div>
                                @endif
                            </div>
                            <div class="d-grid gap-2">
                                <button wire:click="verifyPayment({{ $proof->id }}, 'terverifikasi')" class="btn btn-success">
                                    <i data-lucide="check-circle" style="width: 16px; height: 16px;" class="me-1"></i> Terima
                                </button>
                                <button wire:click="verifyPayment({{ $proof->id }}, 'rejected', 'Bukti tidak valid')" class="btn btn-danger">
                                    <i data-lucide="x-circle" style="width: 16px; height: 16px;" class="me-1"></i> Tolak
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-4">
                        <i data-lucide="inbox" class="icon-lg mb-2" style="width: 48px; height: 48px;"></i>
                        <p class="mb-0">Tidak ada bukti pembayaran yang perlu diverifikasi.</p>
                    </div>
                </div>
            @endforelse
        </div>
        {{ $pendingProofs->links() }}
    @endif
</div>

@push('scripts')
<script>
    // Initialize Lucide icons
    function initIcons() {
        if (window.lucide && window.lucide.createIcons && window.lucide.icons) {
            window.lucide.createIcons({ icons: window.lucide.icons });
        }
    }
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        initIcons();
    });
    
    // Re-initialize icons after Livewire updates
    document.addEventListener('livewire:init', () => {
        Livewire.hook('morph.updated', ({ el, component }) => {
            initIcons();
        });
    });
    
    // Re-initialize after wire:navigate
    document.addEventListener('livewire:navigated', () => {
        initIcons();
    });
</script>
@endpush
