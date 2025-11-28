<?php

namespace App\Livewire\Admin\Complaint;

use App\Models\Complaint;
use Livewire\Component;
use Livewire\WithPagination;

class ManageComplaints extends Component
{
    use WithPagination;

    public $statusFilter = '';
    public $searchTerm = '';

    public function updateStatus($complaintId, $newStatus)
    {
        $complaint = Complaint::findOrFail($complaintId);
        $complaint->update(['status' => $newStatus]);
        
        session()->flash('success', 'Status keluhan berhasil diupdate!');
    }

    public function deleteComplaint($complaintId)
    {
        Complaint::findOrFail($complaintId)->delete();
        session()->flash('success', 'Keluhan berhasil dihapus!');
    }

    public function render()
    {
        $query = Complaint::with(['user', 'room'])
            ->orderBy('created_at', 'desc');

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('title', 'like', '%' . $this->searchTerm . '%')
                  ->orWhereHas('user', function($userQuery) {
                      $userQuery->where('name', 'like', '%' . $this->searchTerm . '%');
                  });
            });
        }

        $complaints = $query->paginate(15);

        return view('livewire.admin.complaint.manage-complaints', [
            'complaints' => $complaints
        ])->layout('layouts.admin-ubold');
    }
}
