<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check())
        {
            // User is logged in, display dashboard
            return view('home');
        }

        // User is not logged in, display login
        return redirect('/login');
    }
}
