@extends('layouts.temp_index')

@section('content')
    <div class="container">
        {{-- <div class="col-md-6 mb-12">

            <div class="form-group">
                <select class="choices form-select multiple-remove" multiple="multiple">
                    <option selected disabled>This is a placeholder</option>
                    <optgroup label="PIC">
                        @foreach ($picEmails as $picEmail)
                            <option value="{{ $picEmail->$picEmail }}">
                                {{ $picEmail->email }}</option>
                        @endforeach

                    </optgroup>
                    <optgroup label="User">
                        @foreach ($userEmails as $userEmail)
                            <option value="{{ $userEmail->$userEmail }}">
                                {{ $userEmail->email }}</option>
                        @endforeach

                    </optgroup>
                </select>
            </div> --}}

    </div>
    <div class="row justify-content-center">
        <div class="col-6 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Invoice Reminder List</h5>
                    <button onclick="addForm()" type="button" class="btn icon icon-left btn-primary block"
                        data-bs-toggle="modal" data-bs-target="#addInvoiceModal">
                        <i data-feather="file-plus"></i> Add New
                    </button>
                </div>
                <div class="card-body">
                    <table class="table" id="invoice-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Invoice Number</th>
                                <th>Vendor</th>
                                <th>Currency</th>
                                <th>Net Value</th>
                                <th>PR Number</th>
                                <th>PO Number</th>
                                <th>SES Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
    </div>

    @include('layouts.invoiceReminder.form')
@endsection

<script>
    // $(document).ready(function() {
    //     let rowCount = 1;

    //     $('#add-row').on('click', function() {
    //         rowCount++;
    //         let newRow = `
    //             <tr>
    //                 <td>
    //                     <input type="text" name="id[]" class="form-control" value="${rowCount}" required>
    //                 </td>
    //                 <td>
    //                     <input type="text" name="pr_number[]" class="form-control" required>
    //                 </td>
    //                 <!-- Add other table data cells as needed -->
    //             </tr>
    //         `;
    //         $('#table-body').append(newRow);
    //     });
    // });
    // function addRow() {
    //     var tr = '<tr>' +
    //         '<td><input type="number" name="rows[0][qty]" class="form-control quantity"></td>' +
    //         '<td><input type="text" name="rows[0][unit]" class="form-control quantity"></td>' +
    //         '<td><input type="text" name="rows[0][description]" class="form-control quantity"></td>' +
    //         '<td><a class="btn btn-danger remove"><i class="fas fa-times"></i></a></td>' +
    //         '</tr>';
    //     $('tbody').append(tr);
    // }
</script>

@section('bot')
    <script type="text/javascript">
        var table = $('#invoice-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('api.invoice') }}",
            columns: [{
                    data: 'ir_id',
                    name: 'ir_id',
                    title: 'ID',
                },
                {
                    data: 'invoice_number',
                    name: 'invoice_number',
                    title: 'Invoice Number',
                },
                {
                    data: 'vendor_name', // Update to use the new column
                    name: 'vendor_id', // Update to use the new column
                    title: 'Vendor',
                },
                {
                    data: 'currency',
                    name: 'currency',
                    title: 'Currency',

                },
                {
                    data: 'net_value',
                    name: 'net_value',
                    title: 'Net Value',
                },
                {
                    data: 'pr_number',
                    name: 'pr_number',
                    render: function(data, type, row) {
                        if (type === 'display' && data) {
                            var prNumbers = data.split(',');
                            var html = '<div class="text-end">';
                            for (var i = 0; i < prNumbers.length; i++) {
                                html += '<span class="badge bg-primary">' + prNumbers[i] + '</span>&nbsp;';
                            }
                            html += '</div>';
                            return html;
                        }
                        return data;
                    }
                }, {
                    data: 'po_number',
                    name: 'po_number',
                    render: function(data, type, row) {
                        if (type === 'display' && data) {
                            var poNumbers = data.split(',');
                            var html = '<div class="text-end">';
                            for (var i = 0; i < poNumbers.length; i++) {
                                html += '<span class="badge bg-primary">' + poNumbers[i] + '</span>&nbsp;';
                            }
                            html += '</div>';
                            return html;
                        }
                        return data;
                    }
                },
                {
                    data: 'ses_migo_number',
                    name: 'ses_migo_number',
                    render: function(data, type, row) {
                        if (type === 'display' && data) {
                            var sesNumbers = data.split(',');
                            var html = '<div class="text-end">';
                            for (var i = 0; i < sesNumbers.length; i++) {
                                html += '<span class="badge bg-primary">' + sesNumbers[i] + '</span>&nbsp;';
                            }
                            html += '</div>';
                            return html;
                        }
                        return data;
                    }
                }, {
                    data: 'status',
                    name: 'status',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        function addForm() {
            save_method = "add";
            $('input[name=_method]').val('POST');
            $('#modal-form form')[0]
                .reset(); // Resetting the tags input fields manually $('#email_to').tagsinput('removeAll');
            $('#email_cc').tagsinput('removeAll');
            $('#net_value').val(',000');

            $('#pr_number').tagsinput('removeAll');
            $('#po_number').tagsinput('removeAll');
            $('#ses_migo_number').tagsinput('removeAll');
            $('#modal-form').modal('show');
            $('.modal-title').text('Add Invoice Reminder');
        }

        function editForm(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $('#email_to, #email_cc, #pr_number, #po_number, #ses_migo_number').tagsinput('removeAll');
            $('#ses_migo_date, #invoice_submitted, #po_number, #ses_migo_number').prop('readonly', false);
            $('#invoice_number, #vendor_id, #currency, #net_value, #pr_number').prop('readonly', false);
            $.ajax({
                url: "{{ url('invoiceReminder') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {

                    $('#modal-form').modal('show');
                    $('.modal-title').text('Edit Invoice Reminder');
                    $('#ir_id').val(data.ir_id);
                    $('#invoice_number').val(data.invoice_number);
                    $('#vendor_id').val(data.vendor_id);
                    $('#vendor_id').text(data.vendor_info);
                    // $('#email_to').val(data.email_to);
                    $('#email_cc').val(data.email_cc);
                    $('#currency').val(data.currency);
                    $('#net_value').val(data.net_value);
                    $('#pr_number').val(data.pr_number);
                    $('#pi_submitted').prop('checked', data.pi_submitted);
                    $('#ses_migo_date').val(data.ses_migo_date);
                    $('#invoice_submitted').prop('checked', data.invoice_submitted);
                    $('#due_date').val(data.due_date);
                    $('#finance_status').val(data.finance_status);
                    if (data.pi_submitted) {
                        $('#pi_submitted').prop('checked', true);
                    } else {
                        $('#pi_submitted').prop('checked', false);
                    }
                    if (data.invoice_submitted) {
                        $('#invoice_submitted').prop('checked', true);
                    } else {
                        $('#invoice_submitted').prop('checked', false);
                    }

                    var emailcc = data.email_cc ? data.email_cc.split(',') : [];
                    $('#email_cc').tagsinput('removeAll');
                    for (var i = 0; i < emailcc.length; i++) {
                        $('#email_cc').tagsinput('add', emailcc[i]);
                    }

                    var prNumbers = data.pr_number ? data.pr_number.split(',') : [];
                    $('#pr_number').tagsinput('removeAll');
                    for (var i = 0; i < prNumbers.length; i++) {
                        $('#pr_number').tagsinput('add', prNumbers[i]);
                    }

                    var poNumbers = data.po_number ? data.po_number.split(',') : [];
                    $('#po_number').tagsinput('removeAll');
                    for (var i = 0; i < poNumbers.length; i++) {
                        $('#po_number').tagsinput('add', poNumbers[i]);
                    }

                    var sesMigoNumbers = data.ses_migo_number ? data.ses_migo_number.split(',') : [];
                    $('#ses_migo_number').tagsinput('removeAll');
                    for (var i = 0; i < sesMigoNumbers.length; i++) {
                        $('#ses_migo_number').tagsinput('add', sesMigoNumbers[i]);
                    }

                },

                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log the error message to console
                    alert("Error: Unable to fetch data"); // Display an alert to the user
                }
            });
        }


        // Handle error console.error(xhr.responseText); } }); }
        function deleteData(id) {
            var csrf_token = $('meta[name="csrf-token" ]').attr('content');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#435ebe',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('invoiceReminder') }}" + '/' + id,
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
                                icon: 'success',
                                timer: '1500'
                            })
                        },
                        error: function() {
                            Swal.fire({
                                title: 'Oops...',
                                text: data.message,
                                icon: 'error',
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
                    var id = $('#ir_id').val();
                    if (save_method == 'add') url = "{{ url('invoiceReminder') }}";
                    else url = "{{ url('invoiceReminder') . '/' }}" + id;
                    console.log('Submitted data:', new FormData($("#modal-form form")[0]));
                    $.ajax({
                        url: url,
                        type: "POST",
                        //hanya untuk input data tanpa dokumen
                        // data : $('#modal-form form').serialize(),
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $('#modal-form').modal('hide');
                            table.ajax.reload();
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                icon: 'success',
                                timer: '1500'
                            })
                        },
                        error: function(xhr, status, error) {
                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            Swal.fire({
                                title: 'Oops...',
                                text: errorMessage,
                                icon: 'error',
                                timer: '1111111500'
                            });
                        }
                    });
                    return false;
                }
            });
        });
    </script>
@endsection
