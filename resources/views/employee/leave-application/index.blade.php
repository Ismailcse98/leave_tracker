@extends('layouts/employee/master')

@section('employee-application')
    menu-open
@endsection

@section('employee-application-list')
    active
@endsection

@section('employee-pending-list')
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
                                <h3 class="card-title">Application List</h3>
                                <a class="btn btn-success btn-sm" style="float: right;" onclick="Show('Add Application','{{ route('employee-leave-application.create') }}')"><i
                                        class=" fa fa-plus"></i>&nbsp; Add Application</a>
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
                                            <th>Status</th>
                                            <th>Application Date</th>
                                            <th>Action</th>
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
                                                <td><span class="badge badge-info">Pending</span></td>
                                                <td>{{ date('d-m-Y', strtotime($application->created_at)) }}</td>
                                                <td>
                                                <a class="btn btn-sm btn-info"
                                            onclick="Show('Update leave type','{{ route('employee-leave-application.edit', $application->id) }}')"><i
                                                class="fa fa-edit text-white"></i></a>
                                        <button class="btn btn-sm btn-danger" onclick="delete_function(this)"
                                            value="{{ route('employee-leave-application.destroy', $application) }}"><i
                                                class="fa fa-trash"></i> </button>
                                                </td>
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
                                            <th>Status</th>
                                            <th>Application Date</th>
                                            <th>Action</th>
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
