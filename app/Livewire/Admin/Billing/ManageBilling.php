<?php

namespace App\Livewire\Admin\Billing;

use App\Models\Bill;
use App\Models\User;
use App\Models\PaymentProof;
use App\Models\Notification;
use App\Exports\PaymentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;
use Livewire\WithPagination;

class ManageBilling extends Component
{
    use WithPagination;

    public $showGenerateForm = false;
    public $selectedUserId;
    public $billAmount;
    public $paymentMethod;
    
    public $activeTab = 'bills'; // bills, pending_proofs

    protected $rules = [
        'selectedUserId' => 'required|exists:users,id',
        'billAmount' => 'required|numeric|min:0',
        'paymentMethod' => 'nullable|string',
    ];

    public function generateBill()
    {
        $this->validate();

        Bill::create([
            'user_id' => $this->selectedUserId,
            'bill_code' => Bill::generateBillCode(),
            'total_amount' => $this->billAmount,
            'payment_method' => $this->paymentMethod,
            'status' => 'belum_dibayar',
        ]);

        // Create notification
        Notification::create([
            'user_id' => $this->selectedUserId,
            'title' => 'Tagihan Baru',
            'message' => 'Anda memiliki tagihan baru sebesar Rp ' . number_format($this->billAmount, 0, ',', '.'),
        ]);

        session()->flash('success', 'Tagihan berhasil dibuat!');
        
        $this->reset(['selectedUserId', 'billAmount', 'paymentMethod', 'showGenerateForm']);
    }

    public function verifyPayment($proofId, $status, $notes = null)
    {
        $proof = PaymentProof::findOrFail($proofId);
        $proof->update([
            'status' => $status,
            'admin_notes' => $notes,
        ]);

        // Update bill status
        if ($status === 'terverifikasi') {
            $proof->bill->update(['status' => 'dibayar']);
            
            // Notification
            Notification::create([
                'user_id' => $proof->user_id,
                'title' => 'Pembayaran Terverifikasi',
                'message' => 'Pembayaran untuk tagihan ' . $proof->bill->bill_code . ' telah diverifikasi.',
            ]);
        } else {
            $proof->bill->update(['status' => 'belum_dibayar']);
            
            // Notification
            Notification::create([
                'user_id' => $proof->user_id,
                'title' => 'Pembayaran Ditolak',
                'message' => 'Pembayaran untuk tagihan ' . $proof->bill->bill_code . ' ditolak. Alasan: ' . ($notes ?? 'Tidak ada catatan'),
            ]);
        }

        session()->flash('success', 'Bukti pembayaran berhasil diproses!');
    }

    public function deleteBill($billId)
    {
        Bill::findOrFail($billId)->delete();
        session()->flash('success', 'Tagihan berhasil dihapus!');
    }

    public function exportPayments()
    {
        return Excel::download(new PaymentsExport(), 'laporan-pembayaran-' . now()->format('Y-m-d') . '.xlsx');
    }

    public function render()
    {
        $tenants = User::where('role', 'penyewa')->get();
        
        $bills = Bill::with(['user', 'paymentProofs'])
            ->orderBy('created_at', 'desc')
            ->paginate(15, ['*'], 'bills_page');

        $pendingProofs = PaymentProof::with(['user', 'bill'])
            ->where('status', 'tertunda')
            ->orderBy('created_at', 'desc')
            ->paginate(10, ['*'], 'proofs_page');

        return view('livewire.admin.billing.manage-billing', [
            'tenants' => $tenants,
            'bills' => $bills,
            'pendingProofs' => $pendingProofs,
        ])->layout('layouts.admin-ubold');
    }
}
