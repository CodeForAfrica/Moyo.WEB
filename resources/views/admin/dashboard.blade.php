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
                        <div class="col-md-2" style="overflow:auto;">
                            <div class="panel panel-default">
                                <div class="panel-heading">Total Drugs</div>
                                <div class="panel-body">
                                    <span><span class="color-pink"><strong>{{ count($data['drugs']) }}</strong></span> Drugs</span>
                                </div>
                            </div>
                        </div><!-- close div .col-md-2 -->

                        <div class="col-md-3" style="overflow:auto;">
                            <div class="panel panel-default">
                                <div class="panel-heading">Total Drug Buying Price Checks</div>
                                <div class="panel-body">
                                    <span><span class="color-pink"><strong>{{ count($data['price_checks']) }}</strong></span> Buying Price Checks</span>
                                </div>
                            </div>
                        </div><!-- close div .col-md-3 -->

                        <div class="col-md-3" style="overflow:auto;">
                            <div class="panel panel-default">
                                <div class="panel-heading">Total Wrong Price Checks</div>
                                <div class="panel-body">
                                    <span><span class="color-pink"><strong>{{ count($data['wrong_checks']) }}</strong></span> Wrong Price Checks</span>
                                </div>
                            </div>
                        </div><!-- close div .col-md-3 -->

                        <div class="col-md-2" style="overflow:auto;">
                            <div class="panel panel-default">
                                <div class="panel-heading">Total Unique Users</div>
                                <div class="panel-body">
                                    <span><span class="color-pink"><strong>{{ count($data['checkers']) }}</strong></span> Users</span>
                                </div>
                            </div>
                        </div><!-- close div .col-md-2 -->

                        <div class="col-md-2" style="overflow:auto;">
                            <div class="panel panel-default">
                                <div class="panel-heading">Total Administrators</div>
                                <div class="panel-body">
                                    <span><span class="color-pink"><strong>{{ count($data['users']) }}</strong></span> Administrators</span>
                                </div>
                            </div>
                        </div><!-- close div .col-md-2 -->
                    </div><!-- close div .row -->

                    <hr />
                    <br />

                    <div class="row">
                        <div class="col-md-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">Recently Drug Buying Price Checks</div>
                                <div class="panel-body">
                                    @if(count($data['price_checks']) > 0)
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Drug Name</th>
                                                    <th>Price</th>
                                                    <th>Buying Price</th>
                                                    <th>Status</th>
                                                    <th>Extra Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $np = 1;
                                                    foreach($data['price_checks'] as $price_check){
                                                        if($price_check->status == "below") $color = "#f49d37";
                                                        if($price_check->status == "equal") $color = "#3ec300";
                                                        if($price_check->status == "above") $color = "#e13700";
                                                    ?>
                                                        <tr>
                                                            <td>{{ $price_check->drug->name }}</td>
                                                            <td>{{ $price_check->drug->price }}</td>
                                                            <td>{{ $price_check->buying_price }}</td>
                                                            <td><span style="color:<?= $color; ?>">{{ ucfirst($price_check->status) }}</span></td>
                                                            <td><span style="color:<?= $color; ?>">{{ $price_check->extra_amount }}</span></td>
                                                        </tr>
                                                    <?php $np++; if($np > 10) break; }
                                                ?>
                                            </tbody>
                                        </table>
                                    @else
                                        <center><h3>There is no any Price Check.</h3></center>
                                    @endif
                                </div>
                            </div>
                        </div><!-- close div .col-md-8 -->

                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">Recently Wrong Price Checks</div>
                                <div class="panel-body">
                                    <?php $nw = 1; ?>
                                     @if(count($data['wrong_checks']) > 0)
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Drug Name</th>
                                                    <th>Buying Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $nw = 1;
                                                    foreach($data['wrong_checks'] as $wrong_check){?>
                                                        <tr>
                                                            <td>{{ $wrong_check->drug_name }}</td>
                                                            <td>{{ $wrong_check->buying_amount }}</td>
                                                        </tr>
                                                    <?php $nw++; if($nw > 10) break; }
                                                ?>
                                            </tbody>
                                        </table>
                                    @else
                                        <center><h3>There is no any Wrong Check.</h3></center>
                                    @endif
                                </div>
                            </div>
                        </div><!-- close div .col-md-4 -->
                    </div><!-- close div .row -->
                </div><!-- close div .main -->
            </div><!-- close div col-md-10 -->
        </div><!-- close div .row -->
    </div><!-- close div .container-fluid -->
@stop