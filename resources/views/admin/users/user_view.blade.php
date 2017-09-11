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
                            <h2>Users <small class="color-pink"> - View User</small></h2>
                        </div>
                        <div class="col-md-2 user">
                            @include('admin.includes.user')
                        </div>
                    </div><!-- close div .row -->
                </div><!-- close div .header -->

                <div class="main">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th style="width:40%;">Fullname</th>
                                    <td>{{ $data['user']->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $data['user']->email }}</td>
                                </tr>
                                <tr>
                                    <th>Date Registered</th>
                                    <td>{{ date('M j Y g:i A', strtotime($data['user']->created_at)) }}</td>
                                </tr>
                            </table>

                            <div class="pull-right">
                                <a href="{{ route('users.delete',$data['user']->id) }}" class="btn btn-md btn-danger no-radius" style="margin-right:10px;" disabled>Delete</a>
                                <a href="{{ route('users.edit',$data['user']->id) }}" type="button" class="btn btn-md btn-warning no-radius" style="margin-right:10px;">Edit</a>
                            </div>
                        </div><!-- close div col-md-12 -->
                    </div><!-- close div .row -->
                </div><!-- close div .main -->
            </div><!-- close div col-md-10 -->
        </div><!-- close div .row -->
    </div><!-- close div .container-fluid -->
@stop