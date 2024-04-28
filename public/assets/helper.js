$(document).ready(function () {
    $(".logout-btn").click(function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You can login again in this system!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout it!'
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Logout!',
                    'Successfully logout from this system.',
                    'success'
                )
                setTimeout(function () {
                    document.getElementById('logout-form').submit();
                }, 1000); //2 second
            }
        })
    });
    
});


function delete_function(objButton) {
    var url = objButton.value;
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                method: 'DELETE',
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
                },
                success: function (data) {
                    if (data.type == 'success') {

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted. ' + data.message,
                            'success'
                        )
                        if (data.url) {
                            setTimeout(function () {
                                location.replace(data.url);
                            }, 800); //
                        } else {
                            setTimeout(function () {
                                location.reload();
                            }, 800); //
                        }
                    } else {
                        Swal.fire(
                            'Wrong!',
                            'Something going wrong. ' + data.message,
                            'warning'
                        )
                    }
                },
            })
        }
    })


}