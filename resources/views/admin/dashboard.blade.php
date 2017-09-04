@extends('layouts.master')

@section('title')
    Administrator - Dashboard | Moyo - Code for Tanzania
@stop

@section('content')
    <div class="container-fluid content-main">
        <div class="row">
            <div class="col-md-2 menus">
                <div class="logo">
                    <img src="../images/heart_white.png"/>
                </div>

                @include('admin.includes.navs')
            </div><!-- close div .col-md-2 -->

            <div class="col-md-10 contents">
                <div class="header">
                    <div class="row">
                        <div class="col-md-10">
                            <h2>Dashboard</h2>
                        </div>
                        <div class="col-md-2 user">
                            @include('admin.includes.user')
                        </div>
                    </div><!-- close div .row -->
                </div><!-- close div .header -->

                <div class="main">
                    <div class="row">
                        <div class="col-md-4" style="overflow:auto;">
                            <div class="panel panel-default">
                                <div class="panel-heading">Total Drugs</div>
                                <div class="panel-body">
                                    <span><span class="color-pink">{{ count($data['drugs']) }}</span> Drugs</span>
                                </div>
                            </div>
                        </div><!-- close div .col-md-4 -->

                        <div class="col-md-4" style="overflow:auto;">
                            <div class="panel panel-default">
                                <div class="panel-heading">Total Drug Buying Price Checks</div>
                                <div class="panel-body">
                                    <span><span class="color-pink">{{ count($data['drugs']) }}</span> Buying Price Checks</span>
                                </div>
                            </div>
                        </div><!-- close div .col-md-4 -->

                        <div class="col-md-4" style="overflow:auto;">
                            <div class="panel panel-default">
                                <div class="panel-heading">Total Users</div>
                                <div class="panel-body">
                                    <span><span class="color-pink">{{ count($data['users']) }}</span> Users</span>
                                </div>
                            </div>
                        </div><!-- close div .col-md-4 -->
                    </div><!-- close div .row -->

                    <hr />
                    <br />

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">Recently Drug Buying Price Checks</div>
                                <div class="panel-body">
                                    <span><span class="color-pink">{{ count($data['drugs']) }}</span> Drugs</span>
                                </div>
                            </div>
                        </div><!-- close div .col-md-12 -->
                    </div><!-- close div .row -->
                </div><!-- close div .main -->
            </div><!-- close div col-md-10 -->
        </div><!-- close div .row -->
    </div><!-- close div .container-fluid -->
@stop