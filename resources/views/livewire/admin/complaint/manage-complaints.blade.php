<div>
    {{-- Page Title --}}
    @include('layouts.partials.page-title', [
        'title' => 'Manajemen Keluhan',
        'breadcrumbs' => [
            ['label' => 'Admin', 'url' => route('admin.dashboard')],
            ['label' => 'Kelola Keluhan']
        ]
    ])

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" wire:model.live="searchTerm" class="form-control" placeholder="Cari judul atau nama penyewa...">
                </div>
                <div class="col-md-3">
                    <select wire:model.live="statusFilter" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="dikirim">Dikirim</option>
                        <option value="diproses">Diproses</option>
                        <option value="ditolak">Ditolak</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Complaints Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Penyewa</th>
                            <th>Kamar</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                            <tr>
                                <td>{{ $complaint->id }}</td>
                                <td>{{ $complaint->user->name }}</td>
                                <td>{{ $complaint->room->name }}</td>
                                <td>
                                    {{ $complaint->title }}
                                    @if($complaint->image_url)
                                        <i class="bi bi-image text-primary" title="Ada gambar"></i>
                                    @endif
                                </td>
                                <td>
                                    <select wire:change="updateStatus({{ $complaint->id }}, $event.target.value)" 
                                            class="form-select form-select-sm">
                                        <option value="dikirim" {{ $complaint->status === 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                                        <option value="diproses" {{ $complaint->status === 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="ditolak" {{ $complaint->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                        <option value="selesai" {{ $complaint->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </td>
                                <td>{{ $complaint->created_at->format('d M Y') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal{{ $complaint->id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button wire:click="deleteComplaint({{ $complaint->id }})" 
                                            wire:confirm="Yakin ingin menghapus keluhan ini?"
                                            class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Detail -->
                            <div class="modal fade" id="detailModal{{ $complaint->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Keluhan</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <dl class="row">
                                                <dt class="col-sm-3">Penyewa:</dt>
                                                <dd class="col-sm-9">{{ $complaint->user->name }}</dd>
                                                
                                                <dt class="col-sm-3">Kamar:</dt>
                                                <dd class="col-sm-9">{{ $complaint->room->name }}</dd>
                                                
                                                <dt class="col-sm-3">Judul:</dt>
                                                <dd class="col-sm-9">{{ $complaint->title }}</dd>
                                                
                                                <dt class="col-sm-3">Deskripsi:</dt>
                                                <dd class="col-sm-9">{{ $complaint->description }}</dd>
                                                
                                                <dt class="col-sm-3">Status:</dt>
                                                <dd class="col-sm-9"><span class="badge {{ status_badge_class($complaint->status) }}">{{ format_status($complaint->status) }}</span></dd>
                                                
                                                <dt class="col-sm-3">Tanggal:</dt>
                                                <dd class="col-sm-9">{{ $complaint->created_at->format('d M Y, H:i') }}</dd>
                                            </dl>
                                            
                                            @if($complaint->image_url)
                                                <div class="mt-3">
                                                    <strong>Gambar:</strong><br>
                                                    <img src="{{ Storage::url($complaint->image_url) }}" class="img-fluid" style="max-height: 400px;">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada keluhan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $complaints->links() }}
            </div>
        </div>
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
