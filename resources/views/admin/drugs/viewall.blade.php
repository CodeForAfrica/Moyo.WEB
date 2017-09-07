@extends('layouts.master')

@section('title')
    Administrator - Drugs | Moyo - Code for Tanzania
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
                            <h2>Drugs <small class="color-pink"> - View All</small></h2>
                        </div>
                        <div class="col-md-2 user">
                            @include('admin.includes.user')
                        </div>
                    </div><!-- close div .row -->
                </div><!-- close div .header -->

                <div class="main">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-login pull-right no-radius" data-toggle="modal" data-target="#newDrugModal">Add New Drug</button>
                        </div>
                    </div><!-- close div .row -->
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            @if(Session::has('message'))
                                <div class="alert alert-{{Session::get('class')}} no-radius" role="alert" style="text-align:left;">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {{Session::get('message')}}
                                </div>
                            @endif
                            
                            @if ($data['drugs'])
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Drug Name</th>
                                        <th>Form</th>
                                        <th>Strength</th>
                                        <th>Unit of Measure (UOM)</th>
                                        <th>Price</th>
                                        <th style="width:170px;">Options</th>
                                    </tr>
                                    </thead>
                                    <tbody style="text-align:left;">
                                        <?php $n=1; ?>
                                        @foreach($data['drugs'] as $drug)
                                        <tr>
                                            <td>{{ $n++ }}</td>
                                            <td>{{ $drug->name }}</td>
                                            <td>{{ $drug->form }}</td>
                                            <td>{{ $drug->strength }}</td>
                                            <td>{{ $drug->uom }}</td>
                                            <td>{{ $drug->price }}</td>
                                            <td>
                                                <a href="{{ route('drugs.delete',$drug->id) }}" class="btn btn-xs btn-danger no-radius" style="margin-right:10px;">Delete</a>
                                                <a href="{{ route('drugs.edit',$drug->id) }}" type="button" class="btn btn-xs btn-warning no-radius" style="margin-right:10px;">Edit</a>
                                                <a href="{{ route('drugs.view',$drug->id) }}" type="button" class="btn btn-xs btn-success no-radius">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <center><h3>There is no any Drug.</h3></center>
                            @endif
                        </div><!-- close div col-md-12 -->
                    </div><!-- close div .row -->
                </div><!-- close div .main -->
            </div><!-- close div col-md-10 -->
        </div><!-- close div .row -->

         <!-- Modal -->
         <div id="newDrugModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content no-radius">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New Drug</h4>
                    </div>
                    <div class="modal-body" style="overflow:auto;padding:20px;font-family: 'Roboto', sans-serif">
                        <form method="post" action="{{ route('drugs.create') }}">
                            {{ csrf_field() }}

                            <label>Drug Name</label>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control no-radius" value="" placeholder="Drug Name" />
                            </div>

                            <label>Form</label>
                            <div class="form-group">
                                <select name="form" class="form-control no-radius">
                                    <option value="0">Choose drug form</option>
                                    <option value="Capsule">Capsule</option>
                                    <option value="Cream">Cream</option>
                                    <option value="Gel">Gel</option>
                                    <option value="Granules">Granules</option>
                                    <option value="Inhalation">Inhalation</option>
                                    <option value="Injection">Injection</option>
                                    <option value="Liquid">Liquid</option>
                                    <option value="Ointment">Ointment</option>
                                    <option value="Pessary">Pessary</option>
                                    <option value="Solution">Solution</option>
                                    <option value="Suppository">Suppository</option>
                                    <option value="Suspension">Suspension</option>
                                    <option value="Syrup">Syrup</option>
                                    <option value="Tablet">Tablet</option>
                                </select>
                            </div>

                            <label>Strength</label>
                            <div class="form-group">
                                <input type="text" name="strength" class="form-control no-radius" value="" placeholder="Strenth" />
                            </div>

                            <label>Unit of Measure (UOM)</label>
                            <div class="form-group">
                                <input type="text" name="uom" class="form-control no-radius" value="" placeholder="Unit of Measure" />
                            </div>

                            <label>Price</label>
                            <div class="form-group">
                                <input type="text" name="price" class="form-control no-radius" value="" placeholder="Price" />
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn btn-md btn-login no-radius pull-right" value="ADD DRUG" />
                            </div>
                        </form>
                    </div>
                </div><!-- close div .modal-content -->
            </div>
        </div><!-- close div .modal -->

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