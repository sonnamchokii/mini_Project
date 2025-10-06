<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    /**
     * Show the application admin dashboard.
     */
    public function index()
    {
        // This line was causing the plain text output.
        // return response("Welcome to the Admin Dashboard! Your Gate check was successful.", 200);
        
        // **FIX:** Now, it will correctly return the admin.dashboard view.
        return view('admin.dashboard'); 
    }
}

