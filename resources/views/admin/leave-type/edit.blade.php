<form id="edit-form">
    @csrf
    <div class="form-group">
      <label for="name">Leave Type Name</label>
      <input type="text" class="form-control" id="name" name="name" value="{{$leaveType->name}}">
      <span class="text-danger" id="name_error"></span>

    </div>
    <button type="submit" id="leaveTypeUpBtn" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp; Update</button>
  </form>

  <script>
    $(document).on('click','#leaveTypeUpBtn',function (event) {
    event.preventDefault();
    $('#name_error').text('');
    var form = $('#edit-form')[0];
    var formData = new FormData(form);
    formData.append('_method','PUT');
    // Set header if need any otherwise remove setup part
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
        }
    });

    $.ajax({
        url: "{{ route('leave-type.update',$leaveType->id) }}",// your request url
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
                    // timer: 1500
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