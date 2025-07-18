<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

final class NotificationController extends Controller
{
    public function index(): Response
    {
        $notifications = Auth::user()->unreadNotifications;

        return Inertia::render('Notifications/Index', [
            'notifications' => NotificationResource::collection($notifications),
        ]);
    }

    public function update(Request $request, DatabaseNotification $notification): RedirectResponse
    {
        $notification->markAsRead();

        return redirect()->route('notifications.index');
    }

    public function destroy(): RedirectResponse
    {
        Auth::user()->unreadNotifications->markAsRead();

        return redirect()->route('notifications.index');
    }
}
