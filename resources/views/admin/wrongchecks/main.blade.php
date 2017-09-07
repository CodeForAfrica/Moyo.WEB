@extends('layouts.master')

@section('title')
    Administrator - Wrong Checks | Moyo - Code for Tanzania
@stop

@section('styles')
    <link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
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
                            <h2>Wrong Checks</h2>
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
                            
                            @if(count($data['wrong_checks']) > 0)
                                <table id="myTable" class="table">
                                    <thead>
                                        <tr>
                                            <th>Drug Name</th>
                                            <th>Buying Price</th>
                                            <th>Date Added</th>
                                            <th style="width:120px;">Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($data['wrong_checks'] as $wrong_check){?>
                                                <tr>
                                                    <td>{{ $wrong_check->drug_name }}</td>
                                                    <td>{{ $wrong_check->buying_amount }}</td>
                                                    <td>{{ $wrong_check->created_at }}</td>
                                                    <td>
                                                        <a href="{{ route('wrongchecks.delete',$wrong_check->id) }}" class="btn btn-xs btn-danger no-radius" style="margin-right:10px;">Delete</a>
                                                       <a href="{{ route('wrongchecks.view',$wrong_check->id) }}" type="button" class="btn btn-xs btn-success no-radius">View</a>
                                                    </td>
                                                </tr>
                                            <?php }
                                        ?>
                                    </tbody>
                                </table>
                            @else
                                <center><h3>There is no any Wrong Check.</h3></center>
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