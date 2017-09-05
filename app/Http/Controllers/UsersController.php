<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        // Checking for session.
        if(!session()->has('user'))
        {
            return redirect('login');
        }
        else{
            $user = session('user');
            $data = array(
                'page' => 'Users',
            );
            return view('admin.users',compact('user','data'));
        }
    }
}
