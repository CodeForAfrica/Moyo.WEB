@extends('layouts.master')

@section('title')
    Administrator - Users | Moyo - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid content-main">
        <div class="row">
            <div class="col-md-2 menus">
                <div class="logo">
                    <img src="{{ asset('images/heart_white.png') }}"/>
                </div>

                @include('admin.includes.navs')
            </div><!-- close div .col-md-2 -->

            <div class="col-md-10 contents">
                <div class="header">
                    <div class="row">
                        <div class="col-md-10">
                            <h2>Users <small class="color-pink"> - Edit User</small></h2>
                        </div>
                        <div class="col-md-2 user">
                            @include('admin.includes.user')
                        </div>
                    </div><!-- close div .row -->
                </div><!-- close div .header -->

                <div class="main">
                    <div class="row">
                        <div class="col-md-12">
                            @if(Session::has('message'))
                                <div class="alert alert-{{Session::get('class')}} no-radius" role="alert" style="text-align:left;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {{Session::get('message')}}
                                </div>
                            @endif

                            <form method="post" action="{{ route('users.update') }}">
                                {{ csrf_field() }}
                
                                <label>Name</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control no-radius" value="{{ $data['user']->name }}" placeholder="Fullname" />
                                </div>
                
                                <label>Email</label>
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control no-radius" value="{{ $data['user']->email }}" placeholder="Email" />
                                </div>
                
                                <label>Date Added</label>
                                <div class="form-group">
                                    <input type="text" name="date_added" class="form-control no-radius" value="{{ $data['user']->created_at }}" placeholder="Date Added" disabled/>
                                </div>

                                <input type="hidden" name="api_token" value="{{ $data['user']->api_token }}" />
                                <input type="hidden" name="id" value="{{ $data['user']->id }}" />
                                <div class="form-group">
                                    <input type="submit" class="btn btn-md btn-login no-radius pull-right" value="Update User" />
                                </div>
                            </form>
                        </div><!-- close div col-md-12 -->
                    </div><!-- close div .row -->
                </div><!-- close div .main -->
            </div><!-- close div col-md-10 -->
        </div><!-- close div .row -->
    </div><!-- close div .container-fluid -->
@stop