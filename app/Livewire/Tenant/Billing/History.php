<?php

namespace App\Livewire\Tenant\Billing;

use App\Models\Bill;
use App\Models\PaymentProof;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class History extends Component
{
    use WithFileUploads, WithPagination;

    public $uploadingForBillId;
    public $proofFile;

    protected $rules = [
        'proofFile' => 'required|image|max:2048',
    ];

    public function openUploadModal($billId)
    {
        $this->uploadingForBillId = $billId;
        $this->reset('proofFile');
    }

    public function uploadProof()
    {
        $this->validate();

        $path = $this->proofFile->store('payment_proofs', 'public');

        PaymentProof::create([
            'user_id' => auth()->id(),
            'bill_id' => $this->uploadingForBillId,
            'payment_proof_url' => $path,
            'status' => 'tertunda',
        ]);

        // Update bill status
        Bill::find($this->uploadingForBillId)->update(['status' => 'verifikasi_tertunda']);

        session()->flash('success', 'Bukti pembayaran berhasil diupload!');
        
        $this->reset(['uploadingForBillId', 'proofFile']);
        
        // Dispatch event to close modal
        $this->dispatch('payment-uploaded');
    }

    public function render()
    {
        $bills = Bill::where('user_id', auth()->id())
            ->with(['paymentProofs'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.tenant.billing.history', [
            'bills' => $bills
        ])->layout('layouts.tenant-ubold');
    }
}
