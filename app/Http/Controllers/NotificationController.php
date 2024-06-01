<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Menampilkan semua notifikasi untuk pengguna tertentu
    public function notif(User $user)
    {
        $notifications = $user->notifications()->latest()->paginate(10);
        return view('notifications', compact('notifications'));
    }

    // Menandai notifikasi sebagai sudah dibaca
    public function markAsRead(Notification $notification)
    {
        $notification->markAsRead();
        return back();
    }

    // Menandai semua notifikasi sebagai sudah dibaca
    public function markAllAsRead(User $user)
    {
        $user->unreadNotifications->markAsRead();
        return back();
    }
}
