<link rel="stylesheet" href="{{ asset('assets') }}/extensions/choices.js/public/assets/styles/choices.css">
<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-bs-backdrop='static'>
    <div class="modal-dialog">
        <div class="modal-content">

            <form id="form-item" method="post" class="form-horizontal" data-bs-toggle="validator"
                enctype="multipart/form-data">
                {{ csrf_field() }} {{ method_field('POST') }}

                <div class="modal-header">
                    <h3 class="modal-title"></h3>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="alert alert-danger" style="display:none"></div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="modal-body">
                    <input type="hidden" id="ir_id" name="ir_id">
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email_cc" class="form-label">email cc :</label>
                                <input type="text" id="email_cc" name="email_cc" class="form-control p-4"
                                    data-role="tagsinput" />
                                {{-- <select name="email_cc" id="email_cc" class="form-control" multiple> --}}
                                <!-- Options will be populated dynamically using JavaScript -->
                                {{-- </select> --}}
                            </div>
                        </div>
                        {{-- <div class="col-md-6 col-12">

                            <div class="form-group">
                                <select class="choices form-select multiple-remove" multiple="multiple"
                                    id="multiple-select">
                                    <optgroup label="PIC">
                                        @foreach ($picEmails as $picEmail)
                                            <option value="{{ $picEmail->id }}">{{ $picEmail->email }}</option>
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="User">
                                        @foreach ($userEmails as $userEmail)
                                            <option value="{{ $userEmail->id }}">{{ $userEmail->email }}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div> --}}

                        {{-- {{ $picEmails }} --}}
                        {{-- <div class="form-group">
                            <select class="choices form-select multiple-remove" multiple="multiple">
                                @foreach ($picEmails as $picEmail)
                                    <option value="{{ $picEmail->email }}">
                                        {{ $picEmail->email }}</option>
                                @endforeach


                            </select>
                        </div> --}}
                    </div>
                    <hr style="height:2px;border-width:0;color:gray;background-color:#0d6efd;">

                    <div class="box-body">
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home"
                                        role="tab" aria-controls="home" aria-selected="true">Proforma</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile"
                                        role="tab" aria-controls="profile" aria-selected="false">Invoice</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact"
                                        role="tab" aria-controls="contact" aria-selected="false">Finance</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <label for="invoice_number" class="form-label">Invoice
                                                    Number:</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="invoice_number" name="invoice_number" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">

                                        </div>
                                        {{-- {{ $vendors }} --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="vendor_id">Vendor:</label>
                                                <select name="vendor_id" id="vendor_id" class="form-control" required>
                                                    <option value="" disabled selected>-- Choose Company --
                                                    </option>
                                                    @foreach ($vendorList as $vendorList)
                                                        <option value="{{ $vendorList->id }}">
                                                            {{ $vendorList->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="currency">Currency</label>
                                                <select name="currency" id="currency" class="form-control">
                                                    <option value="IDR">IDR</option>
                                                    <option value="USD">USD</option>
                                                    {{-- <option value="GBP">GBP</option> --}}
                                                    <!-- Add more currency options as needed -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="net_value" class="form-label">Net Value</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="net_value" name="net_value">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="pr_number" class="form-label">PR Number</label>
                                                <input type="text" id="pr_number" name="pr_number"
                                                    class="form-control p-4" data-role="tagsinput" />
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-12">
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">

                                                <input type="checkbox" id="pi_submitted" name="pi_submitted">
                                                <label for="pi_submitted" class=" form-label">Proforma Invoice</label>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-6 col-12">
                                            <!-- Button to add rows -->
                                            <button class="btn btn-primary add-row">Add Row</button>
                                        </div> --}}
                                        <!-- Table to add rows -->
                                        {{-- <table id="pr_table" class="table table-bordered mt-3">
                                            <thead>
                                                <tr>

                                                    <th>PR Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="table-body">
                                                <!-- Initial row -->
                                                <tr> --}}
                                        {{-- <td>
                                                        <input type="text" name="id[]" class="form-control"
                                                            required>
                                                    </td> --}}
                                        {{-- <td>
                                                        <input type="text" name="pr_number[]" class="form-control"
                                                            required>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="delete-row"><i
                                                                class="fas fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table> --}}
                                        {{-- <hr style="height:2px;border-width:0;color:gray;background-color:#0d6efd;"> --}}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <div class="col 12 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="ses_migo_date" class="form-label">SES/MIGO Date</label>
                                            <input type="date" class="form-control form-control-sm"
                                                id="ses_migo_date" name="ses_migo_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="po_number" class="form-label">PO Number</label>
                                            <input id="po_number" name="po_number" type="text"
                                                class="form-control p-4" data-role="tagsinput" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="ses_migo_number" class="form-label">SES/MIGO Number</label>
                                            <input id="ses_migo_number" name="ses_migo_number" type="text"
                                                class="form-control p-4" data-role="tagsinput" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <input type="checkbox" id="invoice_submitted" name="invoice_submitted">
                                            <label for="invoice_submitted" class=" form-label">Invoice
                                                Submitted</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                    </div>
                                    {{-- <hr style="height:2px;border-width:0;color:gray;background-color:#0d6efd;"> --}}
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel"
                                    aria-labelledby="contact-tab">
                                    <div class="col 12 col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="due_date" class="form-label">Due Date</label>
                                            <input type="date" id="due_date" name="due_date"
                                                class="form-control form-control-sm">
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="finance_status" class="form-label">Finance Status</label>
                                            <select class="form-control form-control-sm" id="finance_status"
                                                name="finance_status">
                                                <option value="MIRO">MIRO</option>
                                                <option value="Clearing">Clearing</option>
                                                <option value="Done">Done</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>

                <div class="modal-footer">
                    {{-- <button type="reset" class="btn btn-light-secondary me-1 mb-1 pull-left">Reset</button> --}}
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Cancel</button>
                    {{-- <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button> --}}
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script>
    // Initialize Choices.js inside the modal
    $(document).ready(function() {
        const selectElement = document.querySelector('#mySelect');
        const choices = new Choices(selectElement, {
            // Add your configuration options here if needed
        });
    });
</script>
<script src="{{ asset('assets') }}/extensions/choices.js/public/assets/scripts/choices.js"></script>
{{-- <script src="{{ asset('assets') }}/js/pages/form-element-select.js"></script> --}}
<script type='text/javascript'>
    // http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/

    $(document).ready(function() {
        // $('input[name="email_to"]').tagsinput({
        //     trimValue: true,
        //     confirmKeys: [13, 44, 32],
        //     focusClass: 'my-focus-class'
        // });

        $('input[name="email_cc"]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32],
            focusClass: 'my-focus-class'
        });
        $('input[name="pr_number"]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32],
            focusClass: 'my-focus-class'
        });
        $('input[name="po_number"]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32],
            focusClass: 'my-focus-class'
        });

        $('input[name="ses_migo_number"]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32],
            focusClass: 'my-focus-class'
        });
        $('.bootstrap-tagsinput input').on('focus', function() {
            $(this).closest('.bootstrap-tagsinput').addClass('has-focus');
        }).on('blur', function() {
            $(this).closest('.bootstrap-tagsinput').removeClass('has-focus');
        });

    });

    // Function to check if the checkbox is checked and enable or disable fields
    // function checkCheckboxPI() {
    //     var piSubmittedCheckbox = $('#pi_submitted');

    //     // Check if the checkbox is checked
    //     if (piSubmittedCheckbox.is(':checked')) {

    //         $('#invoice_number').prop('disabled', true);
    //         $('#vendor').prop('disabled', true);
    //         $('#currency').prop('disabled', true);
    //         $('#net_value').prop('disabled', true);
    //         $('#pr_number').prop('disabled', true);
    //         $('#pi_submitted').prop('disabled', true);
    //         // Enable the fields below the <hr> tag
    //         $('#ses_migo_date').prop('disabled', false);
    //         // $('#invoice_submitted').prop('disabled', false);
    //         $('#po_number').prop('disabled', false);
    //         $('#ses_migo_number').prop('disabled', false);


    //         // $('#pi_submitted').prop('disabled', true);
    //     } else {
    //         // Disable the fields below the <hr> tag
    //         // $('#invoice_submitted').prop('disabled', true);
    //         $('#ses_migo_date').prop('disabled', true);
    //         $('#po_number').prop('disabled', true);
    //         $('#ses_migo_number').prop('disabled', true);
    //         $('#invoice_submitted').prop('disabled', true);
    //         $('#invoice_number').prop('disabled', false);
    //         $('#vendor').prop('disabled', false);
    //         $('#currency').prop('disabled', false);
    //         $('#net_value').prop('disabled', false);
    //         $('#pr_number').prop('disabled', false);
    //         // $('#due_date').prop('disabled', true);
    //         // $('#finance_status').prop('disabled', true);
    //     }

    // }

    // function checkCheckboxInvoice() {

    //     var invoiceSubmittedCheckbox = $('#invoice_submitted');
    //     // Check if the checkbox is checked

    //     if (invoiceSubmittedCheckbox.is(':checked')) {
    //         // Enable the fields below the <hr> tag
    //         $('#po_number').prop('disabled', true);
    //         $('#ses_migo_number').prop('disabled', true);
    //         $('#due_date').prop('disabled', false);
    //         $('#finance_status').prop('disabled', false);
    //         $('#invoice_submitted').prop('disabled', true);
    //     } else {
    //         // Disable the fields below the <hr> tag
    //         $('#due_date').prop('disabled', true);
    //         $('#finance_status').prop('disabled', true);

    //     }
    // }
    // // Check the checkbox on document ready
    // checkCheckboxPI();
    // checkCheckboxInvoice();
    // Add change event listener to the checkbox

    $('#pi_submitted').change(function() {
        if (confirm("Are you sure you want to change the Proforma Invoice status?")) {
            var isChecked = $(this).is(':checked');

            // Enable or disable the fields accordingly
            // $('#ses_migo_date, #invoice_submitted, #po_number, #ses_migo_number').prop('readonly ', !isChecked);
            // $('#invoice_number, #vendor, #currency, #net_value, #pr_number').prop(
            //     'readonly', isChecked);

        } else {
            // If user cancels the confirmation, revert the checkbox state
            $(this).prop('checked', !$(this).prop('checked'));
        }
    });
    $('#invoice_submitted').change(function() {
        // Call the checkCheckbox function when the checkbox state changes
        if (confirm("Are you sure you want to change the Invoice Submitted status?")) {
            var isChecked = $(this).is(':checked');

            // Enable or disable the fields accordingly
            // $('#due_date, #finance_status').prop('readonly ', !isChecked);
            // $('#invoice_submitted').prop('disabled', isChecked);
        } else {
            // If user cancels the confirmation, revert the checkbox state
            $(this).prop('checked', !$(this).prop('checked'));
        }
    });
</script>
