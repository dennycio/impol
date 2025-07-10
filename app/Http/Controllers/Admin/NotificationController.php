<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class AdminNotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()->get();
        return view('admin.notifications.index', compact('notifications'));
    }

    public function create()
    {
        return view('admin.notifications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'target' => 'required|in:all,student,teacher',
        ]);

        Notification::create($request->only('title', 'message', 'target'));

        return redirect()->route('admin.notifications.index')->with('success', 'Notificação criada com sucesso!');
    }

    public function edit(Notification $notification)
    {
        return view('admin.notifications.edit', compact('notification'));
    }

    public function update(Request $request, Notification $notification)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'target' => 'required|in:all,student,teacher',
        ]);

        $notification->update($request->only('title', 'message', 'target'));

        return redirect()->route('admin.notifications.index')->with('success', 'Notificação actualizada com sucesso!');
    }

    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('admin.notifications.index')->with('success', 'Notificação apagada com sucesso!');
    }
}
