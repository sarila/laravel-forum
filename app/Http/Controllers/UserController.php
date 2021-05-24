<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function notifications()

    {
    	// Mark unread as read
    	auth()->user()->unreadNotifications->markAsRead();


    	// dISPLAY ALL NOTIFICATION
    	return view('users.notification', [
    		'notifications' => auth()->user()->notifications()->paginate(10),
    	]);
    }
}
