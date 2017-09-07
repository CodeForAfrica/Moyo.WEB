@extends('layouts.master')

@section('title')
    Administrator - Drugs | Moyo - Code for Tanzania
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
                            <h2>Drugs <small class="color-pink"> - View Drug</small></h2>
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
                                    <td>{{ $data['drug']->name }}</td>
                                </tr>
                                <tr>
                                    <th>Form</th>
                                    <td>{{ $data['drug']->form }}</td>
                                </tr>
                                <tr>
                                    <th>Strength</th>
                                    <td>{{ $data['drug']->strength }}</td>
                                </tr>
                                <tr>
                                    <th>Unit of Measure (UOM)</th>
                                    <td>{{ $data['drug']->uom }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{ $data['drug']->price }}</td>
                                </tr>
                                <tr>
                                    <th>Date Added</th>
                                    <td>{{ $data['drug']->created_at }}</td>
                                </tr>
                            </table>

                            <div class="pull-right">
                                <a href="{{ route('drugs.delete',$data['drug']->id) }}" class="btn btn-md btn-danger no-radius" style="margin-right:10px;">Delete</a>
                                <a href="{{ route('drugs.edit',$data['drug']->id) }}" type="button" class="btn btn-md btn-warning no-radius" style="margin-right:10px;">Edit</a>
                            </div>
                        </div><!-- close div col-md-12 -->
                    </div><!-- close div .row -->
                </div><!-- close div .main -->
            </div><!-- close div col-md-10 -->
        </div><!-- close div .row -->
    </div><!-- close div .container-fluid -->
@stop