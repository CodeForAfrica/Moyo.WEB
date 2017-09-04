<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PriceChecksController extends Controller
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
                'page' => 'PriceChecks',
            );
            return view('admin.pricechecks',compact('user','data'));
        }
    }
}
