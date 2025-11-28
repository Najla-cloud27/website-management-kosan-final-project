<div>
    {{-- Page Title --}}
    @include('layouts.partials.page-title', [
        'title' => 'Manajemen Pengumuman',
        'breadcrumbs' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Pengumuman']
        ]
    ])

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0">Kelola Pengumuman</h5>
        <button wire:click="createNew" class="btn btn-soft-primary">
            <i data-lucide="plus" class="icon-dual icon-xs me-1"></i> Buat Pengumuman
        </button>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($showForm)
        <div class="card mb-4">
            <div class="card-body">
                <h5>{{ $editingId ? 'Edit' : 'Buat' }} Pengumuman</h5>
                <form wire:submit.prevent="save">
                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" wire:model="title" class="form-control @error('title') is-invalid @enderror">
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konten</label>
                        <textarea wire:model="content" class="form-control @error('content') is-invalid @enderror" rows="5"></textarea>
                        @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar (Optional)</label>
                        <input type="file" wire:model="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if($image)
                            <div class="mt-2">
                                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" style="max-width: 200px;">
                            </div>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select wire:model="publish_status" class="form-select">
                            <option value="draf">Draf</option>
                            <option value="diterbitkan">Diterbitkan</option>
                        </select>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" wire:click="$set('showForm', false)" class="btn btn-secondary">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <div class="row">
        @forelse($announcements as $announcement)
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="card-title">{{ $announcement->title }}</h5>
                            <span class="badge bg-{{ $announcement->publish_status === 'diterbitkan' ? 'success' : 'secondary' }}">
                                {{ ucfirst($announcement->publish_status) }}
                            </span>
                        </div>
                        <p class="card-text">{{ Str::limit($announcement->content, 150) }}</p>
                        <p class="text-muted small mb-3">
                            <i class="bi bi-clock"></i> {{ $announcement->created_at->format('d M Y, H:i') }}
                            <i class="bi bi-person ms-2"></i> {{ $announcement->admin->name }}
                        </p>
                        @if($announcement->image_url)
                            <img src="{{ Storage::url($announcement->image_url) }}" class="img-fluid mb-3" style="max-height: 200px;">
                        @endif
                        <div class="d-flex gap-2">
                            <button wire:click="edit({{ $announcement->id }})" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button wire:click="togglePublish({{ $announcement->id }})" class="btn btn-sm btn-info">
                                <i class="bi bi-{{ $announcement->publish_status === 'diterbitkan' ? 'eye-slash' : 'eye' }}"></i>
                            </button>
                            <button wire:click="delete({{ $announcement->id }})" wire:confirm="Hapus pengumuman?" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Belum ada pengumuman.</div>
            </div>
        @endforelse
    </div>

    <div class="mt-3">
        {{ $announcements->links() }}
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
    });

    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons({ icons: window.lucide.icons });
        }
    });
</script>
@endpush
