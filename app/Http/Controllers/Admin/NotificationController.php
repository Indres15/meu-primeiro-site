<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;

        return view('admin.notifications', compact('unreadNotifications'));
    }

    public function readAll()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;

        $unreadNotifications->each(function($notification){
            $notification->markAsRead();
        });

        flash('notificação lidas com sucesso!')-> success();
        return redirect()->back();
    }

    public function read($notification)
    {
        $user = User::find(auth()->id()); 
        $notification = $user->notifications()->find($notification);
        $notification->markAsRead();

        flash('notificação lida com sucesso!')-> success();
        return redirect()->back();
    }
}
