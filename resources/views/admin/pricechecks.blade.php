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
                            <h2>Price Checks</h2>
                        </div>
                        <div class="col-md-2 user">
                            @include('admin.includes.user')
                        </div>
                    </div><!-- close div .row -->
                </div><!-- close div .header -->

                <div class="main">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-login pull-right no-radius">View All Price Checks</button>
                        </div>
                    </div><!-- close div .row -->
                    <br />
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">Top Searched Drugs</div>
                                <div class="panel-body">
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div><!-- close div .col-md-6 -->
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
            type: 'pie',
            data: {
                labels: [
                    <?php
                        $n = 1;
                        foreach($data['price_checks_grouped'] as $group){
                            echo '"'.$group[0]->drug->name.'",';

                            $n++;
                            if($n > 5) break;
                        }
                    ?>
                ],
                datasets: [{
                    label: "Top Searched Drugs",
                    backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                    data: [
                        <?php
                            $n = 1;
                            foreach($data['price_checks_grouped'] as $group){
                                echo '"'.count($group).'",';

                                $n++;
                                if($n > 5) break;
                            }
                        ?>
                    ]
                }]
            },
            options: {}
        });
    </script>
@stop