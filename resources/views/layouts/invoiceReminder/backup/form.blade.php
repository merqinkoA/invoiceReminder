<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true">
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


                <div class="modal-body">
                    <input type="hidden" id="ir_id" name="ir_id">


                    <div class="box-body">
                        <div class="row">


                            {{-- <div class="col-md-2 ">
                                <div class="form-group">

                                </div>
                            </div> --}}

                            <div class="col-md-6 "><label for="invoice_number" class="form-label">Invoice
                                    Number:</label>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" id="invoice_number"
                                        name="invoice_number" required>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                {{-- <input type="number" class="form-control form-control-sm" id="invoice_number" name="invoice_number" value=""> --}}

                            </div>



                            {{-- <div class="col-md-4">
                                <div class="form-group">

                                    <input type="text" class="form-control form-control-sm" id="supplier_name" name="supplier_name" value="" >
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="supplier_name">Company:</label>
                                    <select name="supplier_name" id="supplier_name" class="form-control" required>
                                        <option value="" disabled selected>-- Choose Company --</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="supplier_name">Supplier:</label>
                                    <select name="supplier_name" id="supplier_name" class="choices form-select">
                                        @foreach ($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> --}}
                            {{-- @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach --}}
                            {{-- <div class="col-md-3">
                                <div class="form-group">
                                    <label for="supplier_name">Supplier:</label>
                                    <select name="supplier_name" id="supplier_name_2" class="choices form-select">
                                        <!-- Options will be dynamically populated based on the selection in the first select -->
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-6 ">

                            </div>


                            <script>
                                // // Get references to the select elements
                                // const firstSelect = document.getElementById('supplier_name');
                                // const secondSelect = document.getElementById('supplier_name_2');

                                // // Add event listener to the first select
                                // firstSelect.addEventListener('change', function() {
                                //     const selectedCompany = this.options[this.selectedIndex].getAttribute('data-company');
                                //     populateSecondSelect(selectedCompany);
                                // });

                                // // Function to populate the second select based on the selected company
                                // function populateSecondSelect(selectedCompany) {
                                //     // Clear existing options
                                //     secondSelect.innerHTML = '';

                                //     // Filter vendors based on selected company
                                //     const filteredVendors = @json($vendors->where('company_name', '!=', '')); // Assuming $vendors is a collection

                                //     // Create new options for the second select
                                //     filteredVendors.forEach(function(vendor) {
                                //         const option = document.createElement('option');
                                //         option.value = vendor.id;
                                //         option.textContent = vendor.name;
                                //         secondSelect.appendChild(option);
                                //     });
                                // }
                            </script>


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
                            {{-- <div class="col-md-2 col-12">
                                <div class="form-group">

                                </div>
                            </div> --}}

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="net_value" class="form-label">Net Value</label>
                                    <input type="text" class="form-control form-control-sm" id="net_value"
                                        name="net_value" value="">
                                </div>
                            </div>

                            <div class="col-md-6 col-12">

                            </div>
                            {{--
                            <div class="col-md-4 col-12">
                                <div class="form-group">

                                </div>
                            </div> --}}
                            <div class="col-md-6 col-12">

                            </div>

                            {{-- <div class="col-12 col-md-8 offset-md-4 form-group">
                                <div class='form-check'>
                                    <div class="checkbox">
                                        <input type="checkbox" id="checkbox1" class='form-check-input'
                                            checked>
                                        <label for="checkbox1">Remember Me</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="pr_number" class="form-label">PR Number</label>
                                    <input type="text" id="pr_number" name="pr_number" class="form-control p-4"
                                        data-role="tagsinput" />
                                </div>
                            </div>

                            <div class="col-md-8 col-12">

                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">

                                    <input type="checkbox" id="pi_submitted" name="pi_submitted">
                                    <label for="pi_submitted" class="form-label">Proforma Invoice</label>
                                </div>
                            </div>






                        </div>
                        {{-- <div class="form-group">
                            <label >Phone</label>
                            <input type="text" class="form-control" id="telepon" name="telepon"   required>
                            <span class="help-block with-errors"></span>
                        </div> --}}


                    </div>
                    <!-- /.box-body -->

                </div>
                {{-- <div class="col-12 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
</div> --}}
                <div class="modal-footer">
                    <button type="reset" class="btn btn-light-secondary me-1 mb-1 pull-left">Reset</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger " data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type='text/javascript'>
    // http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/

    $(document).ready(function() {

        $('input[name="pr_number"]').tagsinput({
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
</script>
<script type="text/javascript">
    $(document).ready(function() {
        // Function to check if the checkbox is checked and enable or disable fields
        function checkCheckboxPI() {
            var piSubmittedCheckbox = $('#pi_submitted');

            // Check if the checkbox is checked
            if (piSubmittedCheckbox.is(':checked')) {
                // Enable the fields below the <hr> tag
                $('#ses_migo_date').prop('disabled', false);
                $('#invoice_submitted').prop('disabled', false);
                $('#po_number').prop('disabled', false);
                $('#ses_migo_number').prop('disabled', false);

            } else {
                // Disable the fields below the <hr> tag
                $('#ses_migo_date').prop('disabled', true);
                $('#invoice_submitted').prop('disabled', true);
                $('#po_number').prop('disabled', true);
                $('#ses_migo_number').prop('disabled', true);

            }

        }

        function checkCheckboxInvoice() {

            var invoiceSubmittedCheckbox = $('#invoice_submitted');
            // Check if the checkbox is checked

            if (invoiceSubmittedCheckbox.is(':checked')) {
                // Enable the fields below the <hr> tag

                $('#due_date').prop('disabled', false);
                $('#finance_status').prop('disabled', false);
            } else {
                // Disable the fields below the <hr> tag

                $('#due_date').prop('disabled', true);
                $('#finance_status').prop('disabled', true);
            }
        }
        // Check the checkbox on document ready
        checkCheckboxPI();
        checkCheckboxInvoice();
        // Add change event listener to the checkbox
        $('#pi_submitted').change(function() {
            // Call the checkCheckbox function when the checkbox state changes
            checkCheckboxPI();
        });
        $('#invoice_submitted').change(function() {
            // Call the checkCheckbox function when the checkbox state changes
            checkCheckboxInvoice();
        });
    });
</script>
