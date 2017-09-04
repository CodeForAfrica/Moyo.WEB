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

                <div class="navs">
                    <ul>
                        <li class="active"><span class="fa fa-dashboard" style="font-size:22px;margin-right:8px;"></span>Dashboard</li>
                        <li><span class="fa fa-eyedropper" style="font-size:22px;margin-right:8px;"></span>Drugs</li>
                        <li><span class="fa fa-bar-chart" style="font-size:22px;margin-right:8px;"></span>Visualize</li>
                    </ul>
                </div><!-- close div .navs -->
            </div><!-- close div .col-md-2 -->

            <div class="col-md-10 contents">
                <div class="header">
                    <div class="row">
                        <div class="col-md-9">
                            <h2>Dashboard</h2>
                        </div>
                        <div class="col-md-3 user">
                            Hello
                        </div>
                    </div><!-- close div .row -->
                </div><!-- close div .header -->
            </div><!-- close div col-md-10 -->
        </div><!-- close div .row -->
    </div><!-- close div .container-fluid -->
@stop