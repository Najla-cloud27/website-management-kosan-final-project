<?php

namespace App\Livewire\Public;

use App\Models\Room;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('layouts.public')]
#[Title('Kamar Tersedia - Kosan DiriQ')]
class RoomCatalog extends Component
{
    use WithPagination;

    #[Url(keep: true)]
    public $search = '';

    #[Url(keep: true)]
    public $minPrice = '';

    #[Url(keep: true)]
    public $maxPrice = '';

    #[Url(keep: true)]
    public $statusFilter = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingMinPrice()
    {
        $this->resetPage();
    }

    public function updatingMaxPrice()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['search', 'minPrice', 'maxPrice', 'statusFilter']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Room::query();

        // Search by name
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Filter by price range
        if ($this->minPrice) {
            $query->where('price', '>=', $this->minPrice);
        }

        if ($this->maxPrice) {
            $query->where('price', '<=', $this->maxPrice);
        }

        // Filter by status
        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $rooms = $query->orderBy('created_at', 'desc')->paginate(9);

        return view('livewire.public.room-catalog', [
            'rooms' => $rooms
        ]);
    }
}
