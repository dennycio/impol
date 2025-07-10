<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::whereIn('target', ['all', 'teacher'])
                                     ->latest()
                                     ->get();

        return view('teacher.notifications.index', compact('notifications'));
    }
}
