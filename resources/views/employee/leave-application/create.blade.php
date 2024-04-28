<form id="create-form">
    @csrf
    <div class="form-group">
        <label for="leave_type_id">Leave type</label>
        <select name="leave_type_id" id="leave_type_id" class="form-control">
            <option value="">Select leave type</option>
            @foreach($leave_types as $leave_type)
            <option value="{{$leave_type->id}}">{{$leave_type->name}}</option>
            @endforeach
        </select>
        <span class="text-danger" id="leave_type_id_error"></span>
    </div>

    <div class="form-group">
      <label for="start_date">Start Date</label>
      <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Enter type Name">
      <span class="text-danger" id="start_date_error"></span>
    </div>

    <div class="form-group">
      <label for="end_date">End Date</label>
      <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Enter type Name">
      <span class="text-danger" id="end_date_error"></span>
    </div>

    <div class="form-group">
        <label for="reason">Reason</label>
        <textarea name="reason" id="reason" class="form-control" cols="30" rows="5"></textarea>
        <span class="text-danger" id="reason_error"></span>
    </div>

    <button type="submit" id="leaveAddBtn" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Submit</button>

  </form>

  <script>
    $(document).on('click','#leaveAddBtn',function (event) {
        event.preventDefault();
        $('#leave_type_id_error').text('');
        $('#start_date_error').text('');
        $('#end_date_error').text('');
        $('#reason_error').text('');

        var form = $('#create-form')[0];
        var formData = new FormData(form);

        // Set header if need any otherwise remove setup part
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
            }
        });
        $.ajax({
            url: "{{route('employee-leave-application.store')}}",// your request url
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
                })
                setTimeout(function() {
                    location.reload();
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