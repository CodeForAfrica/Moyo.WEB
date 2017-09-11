@extends('layouts.master')

@section('title')
    Administrator - Price Checks | Moyo - Code for Tanzania
@stop

@section('styles')
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
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
                            <h2>Price Checks <small class="color-pink"> - View All</small></h2>
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
                            
                            @if(count($data['price_checks']) > 0)
                                <table id="myTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>Drug Name</th>
                                            <th>Price</th>
                                            <th>Buying Price</th>
                                            <th>Status</th>
                                            <th>Extra Amount</th>
                                            <th>Date Checked</th>
                                            <th style="width:120px;">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
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
                                                    <td>{{ date('M j Y g:i A', strtotime($price_check->created_at)) }}</td>
                                                    <td>
                                                        <a href="{{ route('pricechecks.delete',$price_check->id) }}" class="btn btn-xs btn-danger no-radius" style="margin-right:10px;">Delete</a>
                                                       <a href="{{ route('pricechecks.view',$price_check->id) }}" type="button" class="btn btn-xs btn-success no-radius">View</a>
                                                    </td>
                                                </tr>
                                            <?php }
                                        ?>
                                    </tbody>
                                </table>
                            @else
                                <center><h3>There is no any Price Check.</h3></center>
                            @endif
                        </div><!-- close div col-md-12 -->
                    </div><!-- close div .row -->
                </div><!-- close div .main -->
            </div><!-- close div col-md-10 -->
        </div><!-- close div .row -->
    </div><!-- close div .container-fluid -->
@stop

@section('scripts')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $('#myTable').DataTable();
        });
    </script>
@stop