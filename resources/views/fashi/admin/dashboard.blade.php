@extends('admin_master')

@section('content')

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Dashboard</h1></div>

                <div class="panel-body">
                    <canvas id="line-chart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
