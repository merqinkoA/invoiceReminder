@extends('layouts.temp_index')



@section('content')
    <div class="card">
        <div class="card-header">
            <h5>PIC List</h5>
            <button onclick="addForm()" type="button" class="btn icon icon-left btn-primary block" data-bs-toggle="modal"
                data-bs-target="#addPicModal">
                <i data-feather="user-plus"></i> Add New
            </button>
        </div>
        <div class="card-body">
            <div style="overflow-x:auto;">
                <table class="table" id="pic-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Vendor</th>
                            <th>Contact Information</th>
                            <th>Address</th>

                            <th>Role</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('pic.form')
@endsection
@section('bot')
    <script type="text/javascript">
        var table = $('#pic-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.pic') }}",
            columns: [{
                    data: 'id',
                    name: 'id',
                    title: 'ID',
                },
                {
                    data: 'name',
                    name: 'name',
                    title: 'Name',
                },

                // {
                //     data: null,
                //     render: function(data, type, full, meta) {
                //         // Combine email, phone, and website with line separators
                //         return data.email + '<br>' + data.phone + '<br>' + data.website;
                //     },
                //     title: 'Contact Information'
                // },
                {
                    data: 'email',
                    name: 'email',
                    title: 'Email',
                }, {
                    data: 'phone',
                    name: 'phone',
                    title: 'Phone',
                }, {
                    data: 'website',
                    name: 'website',
                    title: 'Website',
                },
                {
                    data: 'vendor_name',
                    name: 'vendor_id',
                    title: 'Vendor',
                },
                {
                    data: 'address',
                    name: 'address',
                    title: 'Address',
                },

                {
                    data: 'role_name',
                    name: 'role_id',
                    title: 'Role',
                },



                {
                    data: 'action',
                    name: 'action',
                    title: 'Action',
                    orderable: false,
                    searchable: false,

                }
            ]
        });


        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add PIC');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('pic') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit PIC');

                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#vendor_id').val(data.vendor_id);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#address').val(data.address);
                    $('#role_id').val(data.role_id);
                    $('#website').val(data.website);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log the error message to console
                    alert("Error: Unable to fetch data"); // Display an alert to the user
                }
            });
        }

        function deleteData(id) {
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#435ebe',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('pic') }}" + '/' + id,
                        type: "POST",
                        data: {
                            '_method': 'DELETE',
                            '_token': csrf_token
                        },
                        success: function(data) {
                            table.ajax.reload();
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            });
                        }
                    });
                }
            });
        }

        $(function() {

            $('#modal-form form').on('submit', function(e) {
                if (!e.isDefaultPrevented()) {
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('pic') }}";
                    else url = "{{ url('pic') . '/' }}" + id;

                    $.ajax({
                        url: url,
                        type: "POST",
                        //hanya untuk input data tanpa dokumen
                        //                      data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[
                            0]),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }

                            var swalContent = document.createElement('div');
                            swalContent.setAttribute('contenteditable', 'true');
                            swalContent.textContent = errorMessage;

                            Swal.fire({
                                title: 'Oops...',
                                html: swalContent,
                                icon: 'error',
                                allowEnterKey: false,
                                showCancelButton: false,
                                showConfirmButton: false,
                                focusConfirm: false
                            });
                        }

                    });
                    return false;
                }
            });
        });
    </script>
@endsection
