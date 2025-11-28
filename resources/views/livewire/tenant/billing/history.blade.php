<div>
    @include('layouts.partials.page-title', [
        'title' => 'Riwayat Tagihan',
        'breadcrumbs' => [
            ['label' => 'Penyewa', 'url' => route('tenant.dashboard')],
            ['label' => 'Riwayat Tagihan']
        ]
    ])

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        @forelse($bills as $bill)
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="card-title">{{ $bill->bill_code }}</h5>
                                <p class="mb-1"><strong>Jumlah:</strong> Rp {{ number_format($bill->total_amount, 0, ',', '.') }}</p>
                                <p class="mb-1"><strong>Tanggal:</strong> {{ $bill->created_at->format('d M Y') }}</p>
                                <p class="mb-1">
                                    <strong>Status:</strong>
                                    <span class="badge {{ status_badge_class($bill->status) }}">{{ format_status($bill->status) }}</span>
                                </p>

                                @if($bill->paymentProofs->count() > 0)
                                    <div class="mt-2">
                                        <small><strong>Bukti Pembayaran:</strong></small>
                                        @foreach($bill->paymentProofs as $proof)
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <span class="badge {{ status_badge_class($proof->status) }}">
                                                    {{ format_status($proof->status) }}
                                                </span>
                                                <small class="text-muted">{{ $proof->created_at->format('d M Y, H:i') }}</small>
                                                @if($proof->admin_notes)
                                                    <small class="text-muted">- Catatan: {{ $proof->admin_notes }}</small>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-4 text-end">
                                @if($bill->status === 'belum_dibayar' || ($bill->status === 'verifikasi_tertunda' && $bill->paymentProofs->where('status', 'rejected')->count() > 0))
                                    <button type="button" class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#uploadModal{{ $bill->id }}" wire:click="$set('uploadingForBillId', {{ $bill->id }})">
                                        <i data-lucide="upload" class="icon-dual icon-xs me-1"></i> Upload Bukti Bayar
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upload Modal -->
            <div class="modal fade" id="uploadModal{{ $bill->id }}" tabindex="-1" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Upload Bukti Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Tagihan:</strong> {{ $bill->bill_code }}</p>
                            <p><strong>Jumlah:</strong> Rp {{ number_format($bill->total_amount, 0, ',', '.') }}</p>
                            
                            <div class="mb-3">
                                <label class="form-label">Pilih File Bukti Pembayaran (JPG, PNG, max 2MB)</label>
                                <input type="file" 
                                       wire:model="proofFile" 
                                       class="form-control @error('proofFile') is-invalid @enderror" 
                                       accept="image/jpeg,image/png,image/jpg">
                                @error('proofFile') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                
                                <div wire:loading wire:target="proofFile" class="mt-2">
                                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <small class="text-muted ms-2">Mengupload file...</small>
                                </div>
                            </div>

                            @if($uploadingForBillId == $bill->id && $proofFile)
                                <div class="mt-2">
                                    <label class="form-label">Preview:</label>
                                    <img src="{{ $proofFile->temporaryUrl() }}" class="img-thumbnail d-block" style="max-width: 100%; max-height: 300px;">
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="button" 
                                    wire:click="uploadProof" 
                                    class="btn btn-primary" 
                                    @if(!$proofFile || $uploadingForBillId != $bill->id) disabled @endif
                                    wire:loading.attr="disabled" 
                                    wire:target="uploadProof">
                                <span wire:loading.remove wire:target="uploadProof">
                                    <i data-lucide="upload" class="icon-xs me-1"></i> Upload
                                </span>
                                <span wire:loading wire:target="uploadProof">
                                    <span class="spinner-border spinner-border-sm me-1" role="status"></span>
                                    Uploading...
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Belum ada tagihan.
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $bills->links() }}
    </div>
</div>

@push('scripts')
<script>
    // Initialize Lucide icons after Livewire updates
    document.addEventListener('livewire:init', () => {
        Livewire.hook('morph.updated', ({ el, component }) => {
            if (window.lucide && window.lucide.createIcons) {
                window.lucide.createIcons({ icons: window.lucide.icons });
            }
        });

        // Listen for upload success event to close modal
        Livewire.on('payment-uploaded', () => {
            // Close all modals
            const modals = document.querySelectorAll('.modal.show');
            modals.forEach(modal => {
                const bsModal = bootstrap.Modal.getInstance(modal);
                if (bsModal) {
                    bsModal.hide();
                }
            });
            
            // Remove backdrop manually if still exists
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
            
            // Remove modal-open class from body
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons({ icons: window.lucide.icons });
        }
    });
</script>
@endpush
