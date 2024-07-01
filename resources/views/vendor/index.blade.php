@extends('layouts.temp_index')



@section('content')
    <div class="card">
        <div class="card-header">
            <h5>Vendor List</h5>
            <button onclick="addForm()" type="button" class="btn icon icon-left btn-primary block" data-bs-toggle="modal"
                data-bs-target="#addVendorModal">
                <i data-feather="user-plus"></i> Add New
            </button>
        </div>

        <div class="card-body">
            {{-- <div style="table-responsive"> --}}
            <div style="overflow-x:auto;">
                <table class="table" id="vendor-table" class="display responsive nowrap" width="100%">
                    <thead>
                        <tr>

                            <th>ID</th>
                            <th>Vendor SAP ID</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Website</th>
                            <th>Address</th>
                            <th>Address SAP</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        {{-- </div> --}}
    </div>
    @include('vendor.form')
@endsection
@section('bot')
    <script type="text/javascript">
        var table = $('#vendor-table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('api.vendor') }}",
            columns: [{

                    data: 'id',
                    name: 'id',
                    title: 'ID',
                },
                {
                    data: 'vendor_sap_id',
                    name: 'vendor_sap_id',
                    title: 'SAP ID',
                },
                {
                    data: 'name',
                    name: 'name',
                    title: 'Name',
                },
                {
                    data: 'phone',
                    name: 'phone',
                    title: 'Phone',
                }, {
                    data: 'email',
                    name: 'email',
                    title: 'Email',
                }, {
                    data: 'website',
                    name: 'website',
                    title: 'website',
                },

                // {
                //     data: null,
                //     render: function(data, type, full, meta) {
                //         // Combine email, phone, and website with line separators
                //         return data.email + '<br>' + data.phone + '<br>' + data.website;
                //     },
                //     title: 'Contact Information'
                // },


                // {
                //     data: 'website',
                //     name: 'website',
                //     title: 'note',
                // },
                {
                    data: 'address',
                    name: 'address',
                    title: 'Address',
                },
                {
                    data: 'address_sap',
                    name: 'address_sap',
                    title: 'Address SAP',
                }, {
                    data: 'action',
                    name: 'action',
                    title: 'Action',
                    orderable: false,
                    searchable: false
                },

            ]
        });


        // console.log("Route URL: " + "{{ route('api.vendor') }}");
        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form').modal('show');
            $('#modal-form form')[0].reset();
            $('.modal-title').text('Add Vendor');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('vendor') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Vendor');

                    $('#id').val(data.id);
                    $('#vendor_sap_id').val(data.vendor_sap_id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#phone').val(data.phone);
                    $('#website').val(data.website);
                    $('#address').val(data.address);
                    $('#address_sap').val(data.address_sap);
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
                        url: "{{ url('vendor') }}" + '/' + id,
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
                    if (save_method == 'add') url = "{{ url('vendor') }}";
                    else url = "{{ url('vendor') . '/' }}" + id;

                    $.ajax({
                        url: url,
                        type: "POST",
                        //hanya untuk input data tanpa dokumen
                        //                      data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
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
                            console.error(xhr);
                            console.error(status);
                            console.error(error);

                            Swal.fire({
                                title: 'Oops...',
                                text: 'An error occurred. Please check the console for more details.',
                                icon: 'error',
                                timer: '1500'
                            });
                        }
                    });
                    return false;
                }
            });
        });
    </script>
@endsection
