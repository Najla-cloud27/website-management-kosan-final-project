<?php

namespace App\Livewire\Tenant\Complaint;

use App\Models\Complaint;
use Livewire\Component;
use Livewire\WithPagination;

class ComplaintList extends Component
{
    use WithPagination;

    public $statusFilter = '';

    public function deleteComplaint($id)
    {
        $complaint = Complaint::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
        
        // Only allow deletion if status is 'dikirim'
        if ($complaint->status === 'dikirim') {
            $complaint->delete();
            session()->flash('success', 'Keluhan berhasil dihapus!');
        } else {
            session()->flash('error', 'Keluhan yang sudah diproses tidak dapat dihapus!');
        }
    }

    public function render()
    {
        $query = Complaint::where('user_id', auth()->id())
            ->with(['room'])
            ->orderBy('created_at', 'desc');

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        $complaints = $query->paginate(10);

        return view('livewire.tenant.complaint.complaint-list', [
            'complaints' => $complaints
        ])->layout('layouts.tenant-ubold');
    }
}
