<?php
namespace App\Livewire\Admin\Room;

use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ManageRooms extends Component
{
    use WithFileUploads, WithPagination;

    public $search       = '';
    public $statusFilter = '';

    public $showForm  = false;
    public $editingId = null;

    // Form fields
    public $name;
    public $price;
    public $size_length; // Panjang
    public $size_width;  // Lebar
    public $status = 'tersedia';
    public $description;
    public $fasilitas = [];
    public $main_image;
    public $additional_images = [];

    // Available facilities
    public $availableFasilitas = [
        'AC', 'Wifi', 'Kasur', 'Lemari', 'Meja', 'Kursi',
        'Kamar Mandi Dalam', 'Water Heater', 'TV', 'Kulkas',
    ];

    protected $queryString = ['search', 'statusFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createNew()
    {
        $this->resetForm();
        $this->showForm  = true;
        $this->editingId = null;
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);

        $this->editingId = $room->id;
        $this->name      = $room->name;
        $this->price     = $room->price;

        // Parse size (format: "3x4 meter" atau "3.5x4")
        if ($room->size) {
            $sizeParts         = explode('x', strtolower(str_replace(' meter', '', $room->size)));
            $this->size_length = $sizeParts[0] ?? '';
            $this->size_width  = $sizeParts[1] ?? '';
        }

        $this->status      = $room->status;
        $this->description = $room->description;
        $this->fasilitas   = $room->fasilitas ?? [];

        $this->showForm = true;
    }

    public function save()
    {
        try {
            $validated = $this->validate([
                'name'                => 'required|string|max:255',
                'price'               => 'required|numeric|min:0',
                'size_length'         => 'required|numeric|min:0',
                'size_width'          => 'required|numeric|min:0',
                'status'              => 'required|in:tersedia,terisi,pemeliharaan,sudah_dipesan',
                'description'         => 'nullable|string',
                'fasilitas'           => 'array',
                'main_image'          => 'nullable|image|max:2048',
                'additional_images.*' => 'nullable|image|max:2048',
            ]);

            // Gabungkan panjang x lebar menjadi size
            $size = $this->size_length . 'x' . $this->size_width . ' meter';

            if ($this->editingId) {
                $room = Room::findOrFail($this->editingId);

                // Update main image if uploaded
                if ($this->main_image) {
                    if ($room->main_image_url) {
                        Storage::disk('public')->delete($room->main_image_url);
                    }
$filename = uniqid() . '.' . $this->main_image->getClientOriginalExtension();
$this->main_image->storeAs('rooms', $filename, 'public');
$validated['main_image_url'] = $filename;
                }

                // Update room dengan size yang sudah digabung
                $room->update([
                    'name'           => $this->name,
                    'price'          => $this->price,
                    'size'           => $size,
                    'status'         => $this->status,
                    'description'    => $this->description,
                    'fasilitas'      => $this->fasilitas,
                    'main_image_url' => $validated['main_image_url'] ?? $room->main_image_url,
                ]);

                session()->flash('success', 'Kamar berhasil diperbarui!');
           } else {

    // Generate custom filename
    $filename = uniqid() . '.' . $this->main_image->getClientOriginalExtension();

    // Save file into public/storage/rooms
    $this->main_image->storeAs('rooms', $filename, 'public');

    // Save only filename to database
    $room = Room::create([
        'name'           => $this->name,
        'price'          => $this->price,
        'size'           => $size,
        'status'         => $this->status,
        'description'    => $this->description,
        'fasilitas'      => $this->fasilitas,
        'main_image_url' => $filename,
    ]);

    session()->flash('success', 'Kamar berhasil ditambahkan!');
}

            // Store additional images
            if ($this->additional_images) {
                foreach ($this->additional_images as $image) {
                    $path = $image->store('rooms', 'public');
                    RoomImage::create([
                        'room_id_room'   => $room->id,
                        'image_url_room' => $path,
                    ]);
                }
            }

            $this->resetForm();
            $this->showForm = false;

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $room = Room::findOrFail($id);

            // Delete main image
            if ($room->main_image_url) {
                Storage::disk('public')->delete($room->main_image_url);
            }

            // Delete additional images
            foreach ($room->images as $image) {
                Storage::disk('public')->delete($image->image_url_room);
                $image->delete();
            }

            $room->delete();

            session()->flash('success', 'Kamar berhasil dihapus!');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus kamar: ' . $e->getMessage());
        }
    }

    public function deleteImage($imageId)
    {
        try {
            $image = RoomImage::findOrFail($imageId);
            Storage::disk('public')->delete($image->image_url_room);
            $image->delete();

            session()->flash('success', 'Gambar berhasil dihapus!');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menghapus gambar: ' . $e->getMessage());
        }
    }

    public function resetForm()
    {
        $this->reset([
            'name', 'price', 'size_length', 'size_width', 'status', 'description',
            'fasilitas', 'main_image', 'additional_images', 'editingId',
        ]);
        $this->status = 'tersedia';
    }

    public function cancelForm()
    {
        $this->resetForm();
        $this->showForm = false;
    }

    public function exportRooms()
    {
        $rooms = Room::with('images')->get();

        $filename = 'data-kamar-' . now()->format('Y-m-d-His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($rooms) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, ['ID', 'Nama Kamar', 'Harga', 'Ukuran', 'Status', 'Deskripsi', 'Fasilitas', 'Tanggal Dibuat']);

            // Data rows
            foreach ($rooms as $room) {
                fputcsv($file, [
                    $room->id,
                    $room->name,
                    'Rp ' . number_format($room->price, 0, ',', '.'),
                    $room->size,
                    ucfirst($room->status),
                    $room->description,
                    is_array($room->fasilitas) ? implode(', ', $room->fasilitas) : '',
                    $room->created_at->format('d-m-Y H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function render()
    {
        $rooms = Room::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->withCount('images')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.room.manage-rooms', [
            'rooms' => $rooms,
        ])->layout('layouts.admin-ubold');
    }
}
