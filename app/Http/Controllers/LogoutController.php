<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function index()
    {
        // Destroying session.
        session()->forget('user');
        session()->flush();
        return redirect('/');
    }
}
