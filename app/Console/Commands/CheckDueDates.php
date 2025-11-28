<?php

namespace App\Console\Commands;

use App\Models\Bill;
use App\Models\Notification;
use Illuminate\Console\Command;

class CheckDueDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bills:check-due-dates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check bills that are due in 3 days and create notifications';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $threeDaysFromNow = now()->addDays(3)->format('Y-m-d');
        
        // Find bills that are unpaid and due in 3 days
        $bills = Bill::where('status', 'belum_dibayar')
            ->whereDate('due_date', $threeDaysFromNow)
            ->with('user')
            ->get();

        $notificationCount = 0;

        foreach ($bills as $bill) {
            // Check if notification already exists for this bill
            $existingNotification = Notification::where('user_id', $bill->user_id)
                ->where('type', 'payment_reminder')
                ->where('message', 'like', "%{$bill->bill_code}%")
                ->whereDate('created_at', now()->format('Y-m-d'))
                ->exists();

            if (!$existingNotification) {
                Notification::create([
                    'user_id' => $bill->user_id,
                    'title' => 'Pengingat Pembayaran',
                    'message' => "Tagihan {$bill->bill_code} akan jatuh tempo dalam 3 hari (tanggal {$bill->due_date->format('d M Y')}). Total: Rp " . number_format($bill->total_amount, 0, ',', '.') . ". Segera lakukan pembayaran untuk menghindari denda.",
                    'type' => 'payment_reminder',
                    'is_read' => false,
                ]);

                $notificationCount++;
            }
        }

        $this->info("Checked {$bills->count()} bills. Created {$notificationCount} notifications.");

        return Command::SUCCESS;
    }
}
