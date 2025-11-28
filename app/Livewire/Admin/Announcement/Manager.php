<?php

namespace App\Livewire\Admin\Announcement;

use App\Models\Announcement;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Manager extends Component
{
    use WithFileUploads, WithPagination;

    public $showForm = false;
    public $editingId = null;
    public $title;
    public $content;
    public $publish_status = 'draf';
    public $image;

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'publish_status' => 'required|in:draf,diterbitkan',
        'image' => 'nullable|image|max:2048',
    ];

    public function createNew()
    {
        $this->reset(['editingId', 'title', 'content', 'publish_status', 'image']);
        $this->publish_status = 'draf';
        $this->showForm = true;
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        $this->editingId = $id;
        $this->title = $announcement->title;
        $this->content = $announcement->content;
        $this->publish_status = $announcement->publish_status;
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'admin_id' => auth()->id(),
            'title' => $this->title,
            'content' => $this->content,
            'publish_status' => $this->publish_status,
        ];

        if ($this->image) {
            $data['image_url'] = $this->image->store('announcements', 'public');
        }

        if ($this->editingId) {
            Announcement::find($this->editingId)->update($data);
            session()->flash('success', 'Pengumuman berhasil diupdate!');
        } else {
            Announcement::create($data);
            session()->flash('success', 'Pengumuman berhasil dibuat!');
        }

        $this->reset(['showForm', 'editingId', 'title', 'content', 'image']);
    }

    public function delete($id)
    {
        Announcement::findOrFail($id)->delete();
        session()->flash('success', 'Pengumuman berhasil dihapus!');
    }

    public function togglePublish($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->update([
            'publish_status' => $announcement->publish_status === 'draf' ? 'diterbitkan' : 'draf'
        ]);
        session()->flash('success', 'Status publikasi berhasil diubah!');
    }

    public function render()
    {
        $announcements = Announcement::with('admin')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.announcement.manager', [
            'announcements' => $announcements
        ])->layout('layouts.admin-ubold');
    }
}
