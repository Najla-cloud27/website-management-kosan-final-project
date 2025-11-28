<?php

namespace App\Livewire\Tenant\Complaint;

use App\Models\Complaint;
use App\Models\Room;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateComplaint extends Component
{
    use WithFileUploads;

    public $room_id;
    public $title;
    public $description;
    public $image;

    protected $rules = [
        'room_id' => 'required|exists:rooms,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|max:2048', // 2MB Max
    ];

    public function submit()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('complaints', 'public');
        }

        Complaint::create([
            'user_id' => auth()->id(),
            'room_id' => $this->room_id,
            'title' => $this->title,
            'description' => $this->description,
            'image_url' => $imagePath,
            'status' => 'dikirim',
        ]);

        session()->flash('success', 'Keluhan berhasil dikirim!');
        
        return redirect()->route('tenant.complaints.index');
    }

    public function render()
    {
        $rooms = Room::all();
        
        return view('livewire.tenant.complaint.create-complaint', [
            'rooms' => $rooms
        ])->layout('layouts.tenant-ubold');
    }
}
