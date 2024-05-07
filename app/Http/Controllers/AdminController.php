<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function home()
    {
        $logged_user = Auth::user();
        return view('admin.index', compact('logged_user'));
    }
}
