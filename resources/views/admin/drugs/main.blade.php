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
                            <h2>Drugs</h2>
                        </div>
                        <div class="col-md-2 user">
                            @include('admin.includes.user')
                        </div>
                    </div><!-- close div .row -->
                </div><!-- close div .header -->

                <div class="main">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('drugs.viewall') }}" class="btn btn-login pull-right no-radius">View All Drugs</a>
                        </div>
                    </div><!-- close div .row -->
                    <br />
                    <div class="row">
                        <div class="col-md-12">
                            <canvas id="myChart"></canvas>
                        </div><!-- close div col-md-12 -->
                    </div><!-- close div .row -->
                </div><!-- close div .main -->
            </div><!-- close div col-md-10 -->
        </div><!-- close div .row -->
    </div><!-- close div .container-fluid -->
@stop

@section('scripts')
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: [
                    "Tablet", 
                    "Liquid", 
                    "Capsule", 
                    "Cream", 
                    "Gel", 
                    "Granules", 
                    "Inhalation", 
                    "Injection", 
                    "Ointment", 
                    "Pessary", 
                    "Solution", 
                    "Suppository", 
                    "Suspension", 
                    "Syrup"],
                datasets: [
                    {
                        label: "Drugs",
                        backgroundColor: [
                            "#3e95cd", 
                            "#8e5ea2",
                            "#3cba9f",
                            "#e8c3b9",
                            "#c45850",
                            "#c8e9a0",
                            "#6dd3ce",
                            "#a13d63",
                            "#390040",
                            "#a9a587",
                            "#17a398",
                            "#fcd757",
                            "#33312e",
                            "#ff2ecc"
                        ],
                        data: [
                            {{count($data['tablet_drugs'])}},
                            {{count($data['liquid_drugs'])}},
                            {{count($data['capsule_drugs'])}},
                            {{count($data['cream_drugs'])}},
                            {{count($data['gel_drugs'])}},
                            {{count($data['granules_drugs'])}},
                            {{count($data['inhalation_drugs'])}},
                            {{count($data['injection_drugs'])}},
                            {{count($data['ointment_drugs'])}},
                            {{count($data['pessary_drugs'])}},
                            {{count($data['solution_drugs'])}},
                            {{count($data['suppository_drugs'])}},
                            {{count($data['suspension_drugs'])}},
                            {{count($data['syrup_drugs'])}},
                        ]
                    }
                ]
            },

            // Configuration options go here
            options: {}
        });
    </script>
@stop