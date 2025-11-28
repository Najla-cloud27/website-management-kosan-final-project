<div>
    @include('layouts.partials.page-title', [
        'title' => 'Daftar Keluhan',
        'breadcrumbs' => [
            ['label' => 'Penyewa', 'url' => route('tenant.dashboard')],
            ['label' => 'Keluhan']
        ]
    ])

    <div class="mb-3">
        <a href="{{ route('tenant.complaints.create') }}" class="btn btn-soft-primary">
            <i data-lucide="plus-circle" class="icon-xs me-1"></i> Buat Keluhan Baru
        </a>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filter -->
    <div class="card mb-3">
        <div class="card-body">
            <select wire:model.live="statusFilter" class="form-select" style="max-width: 200px;">
                <option value="">Semua Status</option>
                <option value="dikirim">Dikirim</option>
                <option value="diproses">Diproses</option>
                <option value="ditolak">Ditolak</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>
    </div>

    <!-- Complaints List -->
    @forelse($complaints as $complaint)
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="flex-grow-1">
                        <h5>{{ $complaint->title }}</h5>
                        <p class="text-muted mb-2">
                            <i class="bi bi-door-open"></i> {{ $complaint->room->name }} |
                            <i class="bi bi-clock"></i> {{ $complaint->created_at->format('d M Y') }}
                        </p>
                        <p>{{ $complaint->description }}</p>
                        @if($complaint->image_url)
                            <img src="{{ Storage::url($complaint->image_url) }}" class="img-thumbnail" style="max-width: 200px;">
                        @endif
                    </div>
                    <div class="ms-3">
                        <span class="badge {{ status_badge_class($complaint->status) }}">
                            {{ format_status($complaint->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">
            Belum ada keluhan. <a href="{{ route('tenant.complaints.create') }}">Buat keluhan baru</a>
        </div>
    @endforelse

    {{ $complaints->links() }}
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
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons({ icons: window.lucide.icons });
        }
    });
</script>
@endpush
