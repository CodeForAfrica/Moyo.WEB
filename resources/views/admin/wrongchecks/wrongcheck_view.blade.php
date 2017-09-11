@extends('layouts.master')

@section('title')
    Administrator - Wrong Check | Moyo - Code for Tanzania
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
                            <h2>Wrong Checks <small class="color-pink"> - View Wrong Check</small></h2>
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
                                    <th style="width:40%;">Drug Name</th>
                                    <td>{{ $data['wrong_check']->drug_name }}</td>
                                </tr>
                                <tr>
                                    <th>Buying Price</th>
                                    <td>{{ $data['wrong_check']->buying_amount }}</td>
                                </tr>
                                <tr>
                                    <th>Date Checked</th>
                                    <td>{{ date('M j Y g:i A', strtotime($data['wrong_check']->created_at)) }}</td>
                                </tr>
                            </table>

                            <div class="pull-right">
                                <a href="{{ route('wrongchecks.delete',$data['wrong_check']->id) }}" class="btn btn-md btn-danger no-radius">Delete</a>
                            </div>
                        </div><!-- close div col-md-12 -->
                    </div><!-- close div .row -->
                </div><!-- close div .main -->
            </div><!-- close div col-md-10 -->
        </div><!-- close div .row -->
    </div><!-- close div .container-fluid -->
@stop