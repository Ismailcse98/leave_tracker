@extends('layouts/employee/master')

@section('employee-application')
    menu-open
@endsection

@section('employee-application-list')
    active
@endsection

@section('employee-reject-list')
    active
@endsection

@section('main')
<!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Application List</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Rejected Application List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Leave Type</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Reason</th>
                                            <th>Comments</th>
                                            <th>Status</th>
                                            <th>Application Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($application_lists as $application)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$application->leaveType->name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($application->start_date)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($application->end_date)) }}</td>
                                                <td>{{$application->reason }}</td>
                                                <td>{{$application->comments }}</td>
                                                <td><span class="badge badge-info">Rejected</span></td>
                                                <td>{{ date('d-m-Y', strtotime($application->created_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>SL</th>
                                            <th>Leave Type</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Reason</th>
                                            <th>Comments</th>
                                            <th>Status</th>
                                            <th>Application Date</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
