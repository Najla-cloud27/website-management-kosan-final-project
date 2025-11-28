<div>
    {{-- Page Title --}}
    @include('layouts.partials.page-title', [
        'title' => 'Manajemen Kamar',
        'breadcrumbs' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Manajemen Kamar']
        ]
    ])

    {{-- Room Management Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <p class="text-muted mb-0">Kelola data kamar kosan</p>
        </div>
        <div class="d-flex gap-2">
            <button wire:click="exportRooms" class="btn btn-success">
                <i data-lucide="file-spreadsheet" class="icon-dual icon-xs me-1"></i> Export Excel
            </button>
            <button wire:click="createNew" class="btn btn-primary">
                <i data-lucide="plus" class="icon-dual icon-xs me-1"></i> Tambah Kamar
            </button>
        </div>
    </div>

    {{-- Success & Error Messages --}}
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i data-lucide="check-circle" class="icon-dual icon-xs me-1"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i data-lucide="alert-circle" class="icon-dual icon-xs me-1"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i data-lucide="check-circle" class="icon-dual icon-xs me-1"></i>
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filters --}}
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="position-relative">
                        <input type="text" wire:model.live="search" class="form-control ps-5" placeholder="Cari kamar...">
                        <i data-lucide="search" class="icon-dual icon-xs position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <select wire:model.live="statusFilter" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="terisi">Terisi</option>
                        <option value="sudah_dipesan">Sudah Dipesan</option>
                        <option value="pemeliharaan">Pemeliharaan</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Modal --}}
    @if($showForm)
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="mb-0">{{ $editingId ? 'Edit Kamar' : 'Tambah Kamar Baru' }}</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Kamar *</label>
                        <input type="text" wire:model="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Harga per Bulan (Rp) *</label>
                        <input type="text" wire:model="price" data-rupiah class="form-control @error('price') is-invalid @enderror" placeholder="Masukkan harga">
                        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Panjang (meter) *</label>
                        <input type="number" step="0.1" wire:model="size_length" class="form-control @error('size_length') is-invalid @enderror" placeholder="3">
                        @error('size_length') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Lebar (meter) *</label>
                        <input type="number" step="0.1" wire:model="size_width" class="form-control @error('size_width') is-invalid @enderror" placeholder="4">
                        @error('size_width') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Status *</label>
                        <select wire:model="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="tersedia">Tersedia</option>
                            <option value="terisi">Terisi</option>
                            <option value="sudah_dipesan">Sudah Dipesan</option>
                            <option value="pemeliharaan">Pemeliharaan</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Gambar Utama *</label>
                        <input type="file" wire:model="main_image" class="form-control @error('main_image') is-invalid @enderror" accept="image/*">
                        @error('main_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        @if ($main_image)
                            <img src="{{ $main_image->temporaryUrl() }}" class="img-thumbnail mt-2" style="max-height: 100px">
                        @elseif($editingId)
                            @php $room = \App\Models\Room::find($editingId); @endphp
                            @if($room && $room->main_image_url)
                                <img src="{{ asset('storage/' . $room->main_image_url) }}" class="img-thumbnail mt-2" style="max-height: 100px">
                            @endif
                        @endif
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi</label>
                        <textarea wire:model="description" rows="3" class="form-control @error('description') is-invalid @enderror"></textarea>
                        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Fasilitas</label>
                        <div class="row g-2">
                            @foreach($availableFasilitas as $fasilitas_item)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input type="checkbox" wire:model="fasilitas" value="{{ $fasilitas_item }}" class="form-check-input" id="fas-{{ $loop->index }}">
                                    <label class="form-check-label" for="fas-{{ $loop->index }}">{{ $fasilitas_item }}</label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Gambar Tambahan (Opsional)</label>
                        <input type="file" wire:model="additional_images" class="form-control" accept="image/*" multiple>
                        @error('additional_images.*') <div class="text-danger small">{{ $message }}</div> @enderror
                        @if ($additional_images)
                            <div class="d-flex gap-2 mt-2">
                                @foreach($additional_images as $image)
                                    <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail" style="max-height: 100px">
                                @endforeach
                            </div>
                        @endif
                    </div>

                    @if($editingId)
                        @php $room = \App\Models\Room::with('images')->find($editingId); @endphp
                        @if($room && $room->images->count() > 0)
                        <div class="col-12">
                            <label class="form-label">Gambar Tambahan Saat Ini</label>
                            <div class="d-flex gap-2 flex-wrap">
                                @foreach($room->images as $image)
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $image->image_url_room) }}" class="img-thumbnail" style="max-height: 100px">
                                    <button type="button" wire:click="deleteImage({{ $image->id_room }})" wire:confirm="Hapus gambar ini?" class="btn btn-danger btn-sm position-absolute top-0 end-0">
                                        <i data-lucide="x" class="icon-dual icon-xs"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    @endif
                </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i data-lucide="save" class="icon-dual icon-xs me-1"></i> {{ $editingId ? 'Update' : 'Simpan' }}
                    </button>
                    <button type="button" wire:click="cancelForm" class="btn btn-secondary">
                        <i data-lucide="x" class="icon-dual icon-xs me-1"></i> Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- Rooms List --}}
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-centered table-hover table-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Kamar</th>
                            <th>Harga</th>
                            <th>Ukuran</th>
                            <th>Status</th>
                            <th>Fasilitas</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                        <tr>
                            <td>
                                @if($room->main_image_url)
                    <img src="{{ asset('storage/rooms/' . $room->main_image_url) }}" style="width: 20px; height: 30px;">
                                @else
                                    <div class="avatar-md">
                                        <span class="avatar-title bg-soft-secondary text-secondary rounded fs-18">
                                            <i data-lucide="image"></i>
                                        </span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $room->name }}</strong>
                                @if($room->description)
                                    <br><small class="text-muted">{{ Str::limit($room->description, 50) }}</small>
                                @endif
                            </td>
                            <td>Rp {{ number_format($room->price, 0, ',', '.') }}</td>
                            <td>{{ $room->size }} m²</td>
                            <td>
                                <span class="badge {{ status_badge_class($room->status) }}">{{ format_status($room->status) }}</span>
                            </td>
                            <td>
                                @if($room->fasilitas && is_array($room->fasilitas) && count($room->fasilitas) > 0)
                                    <small>{{ implode(', ', array_slice($room->fasilitas, 0, 3)) }}</small>
                                    @if(count($room->fasilitas) > 3)
                                        <small class="text-muted">+{{ count($room->fasilitas) - 3 }}</small>
                                    @endif
                                @else
                                    <small class="text-muted">-</small>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">{{ $room->images_count }} foto</small>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <button wire:click="edit({{ $room->id }})" class="btn btn-sm btn-soft-primary" title="Edit">
                                        <i data-lucide="edit" class="icon-dual icon-xs"></i>
                                    </button>
                                    <button wire:click="delete({{ $room->id }})" wire:confirm="Hapus kamar {{ $room->name }}?" class="btn btn-sm btn-soft-danger" title="Hapus">
                                        <i data-lucide="trash-2" class="icon-dual icon-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <i data-lucide="inbox" class="icon-dual" style="width: 64px; height: 64px;"></i>
                                    <p class="mt-2 mb-0">Belum ada kamar</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($rooms->hasPages())
        <div class="card-footer">
            {{ $rooms->links() }}
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    // Initialize Lucide icons after Livewire updates
    document.addEventListener('livewire:init', () => {
        Livewire.hook('morph.updated', ({ el, component }) => {
            // Reinitialize Lucide icons after DOM update
            if (window.lucide && window.lucide.createIcons) {
                window.lucide.createIcons({ icons: window.lucide.icons });
            }
        });
    });

    // Also reinitialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons({ icons: window.lucide.icons });
        }
    });
</script>
@endpush
