<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function notif()
    {
        $notifications = auth()->user()->notifications;

        return view('notifications', compact('notifications'));
    }

    public function comments()
    {
        $notifications = auth()->user()->notifications()->where('type', 'comment')->get();

        return view('notifications', compact('notifications'));
    }

    public function likes()
    {
        $notifications = auth()->user()->notifications()->where('type', 'like')->get();

        return view('notifications', compact('notifications'));
    }
}
