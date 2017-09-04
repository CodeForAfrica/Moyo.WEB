@extends('layouts.master')

@section('title')
    Administrator - Login | Moyo - Code for Tanzania
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 login-box">
                <div class="brand">
                    <img src="{{ asset('images/heart.png') }}"/>
                </div>

                <div class="login-form">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Username or email" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" />
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-lg btn-block btn-login no-radius">LOGIN</button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- close div .container -->
@stop