<?php

namespace App\Livewire;

use App\Models\Notification;
use Livewire\Component;

class NotificationBell extends Component
{
    public $unreadCount = 0;
    public $notifications = [];
    public $showDropdown = false;

    protected $listeners = ['notificationRead' => 'refreshNotifications'];

    public function mount()
    {
        $this->refreshNotifications();
    }

    public function refreshNotifications()
    {
        if (auth()->check()) {
            $this->unreadCount = Notification::where('user_id', auth()->id())
                ->where('is_read', false)
                ->count();

            $this->notifications = Notification::where('user_id', auth()->id())
                ->orderBy('created_at', 'desc')
                ->take(10) // Show 10 most recent notifications
                ->get();
        }
    }

    public function markAsRead($notificationId)
    {
        $notification = Notification::find($notificationId);
        
        if ($notification && $notification->user_id === auth()->id()) {
            $notification->update(['is_read' => true]);
            $this->refreshNotifications();
        }
    }

    public function markAllAsRead()
    {
        Notification::where('user_id', auth()->id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
            
        $this->refreshNotifications();
    }

    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

    public function render()
    {
        return view('livewire.notification-bell');
    }
}
