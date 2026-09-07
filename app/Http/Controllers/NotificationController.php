<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Route;

class NotificationController extends Controller {
    /**
     * Handle notification click.
     */
    public function handle(string $notification) {
        $notification = auth()->user()->notifications()->where('not_id', $notification)->firstOrFail();
        $notification->markAsRead();
        $route = $notification->not_data['route'] ?? 'dashboard';
        $params = $notification->not_data['params'] ?? [];

        if (!Route::has($route)) {
            return redirect()->route('dashboard');
        }
        return redirect()->route($route, $params);
    }

    /**
     * Mark notification as read.
     */
    public function read(string $notification) {
        $notification = auth()->user()->notifications()->where('not_id', $notification)->firstOrFail();
        $notification->markAsRead();
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Mark all notifications as read.
     */
    public function readAll() {
        auth()->user()->notifications()->whereNull('not_read_at')->update(['not_read_at' => now(),]);
        return response()->json([
            'success' => true,
        ]);
    }
}
