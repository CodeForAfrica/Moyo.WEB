<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WrongChecksController extends Controller
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
                'page' => 'WrongChecks',
            );
            return view('admin.wrongchecks',compact('user','data'));
        }
    }
}