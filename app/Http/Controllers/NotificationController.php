<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Display notifications.
     */
   public function index(Request $request): View
{
    $user = auth()->user();

    if (!$user) {
        abort(403, 'User is not logged in.');
    }

    $notifications = $user->notifications()
        ->latest()
        ->paginate(15);

    $unreadCount = $user->unreadNotifications()->count();

    return view('notifications.index', [
        'notifications' => $notifications,
        'unreadCount' => $unreadCount,
    ]);
}
    /**
     * Mark one notification as read.
     */
    public function markAsRead(string $id): RedirectResponse
    {
        $user = request()->user();

        abort_unless($user, 401);

        $notification = $user->notifications()
            ->where('id', $id)
            ->firstOrFail();

        $notification->markAsRead();

        return back()->with(
            'success',
            'Notification marked as read.'
        );
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(): RedirectResponse
    {
        $user = request()->user();

        abort_unless($user, 401);

        $user->unreadNotifications->markAsRead();

        return back()->with(
            'success',
            'All notifications marked as read.'
        );
    }

    /**
     * Delete one notification.
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = request()->user();

        abort_unless($user, 401);

        $notification = $user->notifications()
            ->where('id', $id)
            ->firstOrFail();

        $notification->delete();

        return back()->with(
            'success',
            'Notification deleted successfully.'
        );
    }

    /**
     * Delete all notifications.
     */
    public function destroyAll(): RedirectResponse
    {
        $user = request()->user();

        abort_unless($user, 401);

        $user->notifications()->delete();

        return back()->with(
            'success',
            'All notifications deleted successfully.'
        );
    }
}