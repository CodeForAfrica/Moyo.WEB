@extends('layouts.master')

@section('title')
    Administrator - Price Check | Moyo - Code for Tanzania
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
                            <h2>Price Checks <small class="color-pink"> - View Price Check</small></h2>
                        </div>
                        <div class="col-md-2 user">
                            @include('admin.includes.user')
                        </div>
                    </div><!-- close div .row -->
                </div><!-- close div .header -->

                <div class="main">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                if($data['price_check']->status == "below") $color = "#f49d37";
                                if($data['price_check']->status == "equal") $color = "#3ec300";
                                if($data['price_check']->status == "above") $color = "#e13700";
                            ?>
                            <table class="table">
                                <tr>
                                    <th style="width:40%;">Drug Name</th>
                                    <td>{{ $data['price_check']->drug->name }}</td>
                                </tr>
                                <tr>
                                    <th>Drug Price</th>
                                    <td>{{ $data['price_check']->drug->price }}</td>
                                </tr>
                                <tr>
                                    <th>Buying Price</th>
                                    <td>{{ $data['price_check']->buying_price }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td><span style="color:<?= $color; ?>">{{ ucfirst($data['price_check']->status) }}</span></td>
                                </tr>
                                <tr>
                                    <th>Extra Amount</th>
                                    <td><span style="color:<?= $color; ?>">{{ $data['price_check']->extra_amount }}</span></td>
                                </tr>
                            </table>

                            <div class="pull-right">
                                <a href="{{ route('pricechecks.delete',$data['price_check']->id) }}" class="btn btn-md btn-danger no-radius">Delete</a>
                            </div>
                        </div><!-- close div col-md-12 -->
                    </div><!-- close div .row -->
                </div><!-- close div .main -->
            </div><!-- close div col-md-10 -->
        </div><!-- close div .row -->
    </div><!-- close div .container-fluid -->
@stop