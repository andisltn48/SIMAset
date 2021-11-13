<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class NotificationController extends Controller
{
    public function markNotification(Request $request){
        // Auth::user()
        //     ->unreadNotifications
        //     ->when($request->input('id'), function ($query) use ($request) {
        //         return $query->where('id', $request->input('id'));
        //     })
        //     ->markAsRead();
        Auth::user()
        ->unreadNotifications
        ->markAsRead();

        return response()->noContent();
    }

    public function clearNotification(Request $request)
    {
        $allnotification = Auth::user()->notifications;
        foreach ($allnotification as $key => $value) {
            $value->delete();
        }
    }
}
