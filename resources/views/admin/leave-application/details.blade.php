@extends('layouts/admin/master')
@section('application')
    menu-open
@endsection
@section('application-list')
    active
@endsection

@section('pending-list')
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
                <li class="breadcrumb-item active">Application Details</li>
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
                        <h3 class="card-title">Application Details</h3>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5>Employee Name</h5>
                                            <div class="post">
                                                <p>{{$application->user->name}} </p>
                                            </div>

                                            <h5>Leave Type</h5>
                                            <div class="post">
                                                <p>{{$application->leaveType->name}}</p>
                                            </div>

                                            <h5>Leave Date</h5>
                                            <div class="post">
                                                <p><strong>Start Date : </strong> {{$application->start_date}} To <strong>End Date : </strong> {{$application->end_date}} </p>
                                            </div>

                                            <h5>Reason</h5>
                                            <div class="post">
                                                <p>{{$application->reason}}</p>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                    <form id="update-form">
                                        <div class="form-group">
                                            <label for="name">Comments</label>
                                            <textarea name="comments" id="comments" class="form-control" cols="30" rows="5"></textarea>
                                            <span class="text-danger" id="comments_error"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Select Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Select status</option>
                                                <option value="approve">Approve</option>
                                                <option value="reject">Reject</option>
                                            </select>
                                            <span class="text-danger" id="status_error"></span>
                                        </div>

                                        <button type="submit" id="submitBtn" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Submit</button>
                                    </form>
                                </div>
                            </div>
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

    @push('scripts')
    <script>
    $(document).on('click','#submitBtn',function (event) {
    event.preventDefault();
    $('#comments_error').text('');
    $('#status_error').text('');
    var form = $('#update-form')[0];
    var formData = new FormData(form);
    formData.append('_method','PUT');
    // Set header if need any otherwise remove setup part
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
        }
    });

    $.ajax({
        url: "{{ route('leave-application.update',$application->id) }}",// your request url
        data: formData,
        processData: false,
        contentType: false,
        type: 'POST',
        success: function (data) {
                Swal.fire({
                    position: 'top-end',
                    icon: data.type,
                    title: data.message,
                    showConfirmButton: false,
                    // timer: 1000
                })
                setTimeout(function() {
                    window.location = "/leave-application";
                }, 1000);
            },
            error: function (data) {
                var errorMessage = '<div class="card bg-danger">\n' +
                            '<div class="card-body text-center p-5">\n' +
                            '<span class="text-white">';
                $.each(data.responseJSON.errors, function(key, value) {
                    errorMessage += ('' + value + '<br>');
                    $("#" + key + "_error").text(value[0]);
                });
                errorMessage += '</span>\n' +
                    '</div>\n' +
                    '</div>';
                
            }
    });

 });
</script>
@endpush

@endsection
