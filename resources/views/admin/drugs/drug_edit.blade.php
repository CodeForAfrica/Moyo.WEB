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
                            <h2>Drugs <small class="color-pink"> - Edit Drug</small></h2>
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

                            <form method="post" action="{{ route('drugs.update') }}">
                                {{ csrf_field() }}

                                <label>Drug Name</label>
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control no-radius" value="{{ $data['drug']->name }}" placeholder="Drug Name" />
                                </div>

                                <label>Form</label>
                                <div class="form-group">
                                    <select name="form" class="form-control no-radius">
                                        <option value="0">Choose drug form</option>
                                        <option value="Capsule" {{ $data['drug']->form == 'Capsule' ? 'selected="selected"' : '' }}>Capsule</option>
                                        <option value="Cream" {{ $data['drug']->form == 'Cream' ? 'selected="selected"' : '' }}>Cream</option>
                                        <option value="Gel" {{ $data['drug']->form == 'Gel' ? 'selected="selected"' : '' }}>Gel</option>
                                        <option value="Granules" {{ $data['drug']->form == 'Granules' ? 'selected="selected"' : '' }}>Granules</option>
                                        <option value="Inhalation" {{ $data['drug']->form == 'Inhalation' ? 'selected="selected"' : '' }}>Inhalation</option>
                                        <option value="Injection" {{ $data['drug']->form == 'Injection' ? 'selected="selected"' : '' }}>Injection</option>
                                        <option value="Liquid" {{ $data['drug']->form == 'Liquid' ? 'selected="selected"' : '' }}>Liquid</option>
                                        <option value="Ointment" {{ $data['drug']->form == 'Ointment' ? 'selected="selected"' : '' }}>Ointment</option>
                                        <option value="Pessary" {{ $data['drug']->form == 'Pessary' ? 'selected="selected"' : '' }}>Pessary</option>
                                        <option value="Solution" {{ $data['drug']->form == 'Solution' ? 'selected="selected"' : '' }}>Solution</option>
                                        <option value="Suppository" {{ $data['drug']->form == 'Suppository' ? 'selected="selected"' : '' }}>Suppository</option>
                                        <option value="Suspension" {{ $data['drug']->form == 'Suspension' ? 'selected="selected"' : '' }}>Suspension</option>
                                        <option value="Syrup" {{ $data['drug']->form == 'Syrup' ? 'selected="selected"' : '' }}>Syrup</option>
                                        <option value="Tablet" {{ $data['drug']->form == 'Tablet' ? 'selected="selected"' : '' }}>Tablet</option>
                                    </select>
                                </div>

                                <label>Strength</label>
                                <div class="form-group">
                                    <input type="text" name="strength" class="form-control no-radius" value="{{ $data['drug']->strength }}" placeholder="Drug Strength" />
                                </div>

                                <label>Unit of Measure (UOM)</label>
                                <div class="form-group">
                                    <input type="text" name="uom" class="form-control no-radius" value="{{ $data['drug']->uom }}" placeholder="Drug UOM" />
                                </div>

                                <label>Price</label>
                                <div class="form-group">
                                    <input type="text" name="price" class="form-control no-radius" value="{{ $data['drug']->price }}" placeholder="Drug Price" />
                                </div>

                                <input type="hidden" name="id" value="{{ $data['drug']->id }}" />
                                <div class="form-group">
                                    <input type="submit" class="btn btn-md btn-login no-radius pull-right" value="Update Drug" />
                                </div>
                            </form>
                        </div><!-- close div col-md-12 -->
                    </div><!-- close div .row -->
                </div><!-- close div .main -->
            </div><!-- close div col-md-10 -->
        </div><!-- close div .row -->
    </div><!-- close div .container-fluid -->
@stop