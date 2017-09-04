<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        // Checking for session.
        if(session()->has('user'))
        {
            return redirect('dashboard');
        }
        else{
            return view('admin.login');
        }
    }
}
