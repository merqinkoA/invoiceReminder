@extends('layouts.temp_index')

@section('content')




      <div class="container">
        <div class="row justify-content-center">
          <div class="col-6 col-md-12">

      <div class="card">
        <div class="card-header">
            <h5 class="card-title"> Invoice Reminder</h5>


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
                    <form action="{{ route('invoiceReminder.update',$invoice_reminder->ir_id) }}"  method="POST" class="form">
                        @csrf
                        @method('put')
                        <div class="row">


                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label for="invoice_number" class="form-label">Invoice Number</label>
                                         </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                            <input type="number" class="form-control form-control-sm" id="invoice_number" name="invoice_number" value="{{$invoice_reminder->invoice_number}}" required>
                                            @if ($errors->has('invoice_number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('invoice_number') }}</strong>
                                            </span>
                                        @endif

                                        </div>
                            </div>
                            <div class="col-md-6 ">

                            </div>


                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label for="supplier_name" class="form-label">Supplier Name</label>
                                   </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                    {{-- <input type="text" class="form-control form-control-sm" id="supplier_name" name="supplier_name" value="{{$invoice_reminder->supplier_name}}"  > --}}

                                    <select name="supplier_name" id="supplier_name" class="form-control">
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}" @if ($vendor->id == $invoice_reminder->supplier_name) selected @endif>
                                                {{ $vendor->name }} ({{ $vendor->company_name }})
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('supplier_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('supplier_name') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>

                            <div class="col-md-6 ">

                            </div>

                            <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="currency">Currency</label>

                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <select name="currency" id="currency" class="form-control">
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="GBP">GBP</option>
                                    <!-- Add more currency options as needed -->
                                </select>
                            </div>
                        </div>

                        <div class="col-md-8 col-12">

                        </div>

                            <div class="col-md-2 col-12">
                                <div class="form-group">
                                    <label for="net_value" class="form-label"  >Net Value</label>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" id="net_value" name="net_value" value="{{$invoice_reminder->net_value}}">
                                    @if ($errors->has('net_value'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('net_value') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="col-md-8 col-12">

                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    {{-- <label for="pi_submitted" class="form-label">PI Submitted</label>
                                    <input type="checkbox" id="pi_submitted" name="pi_submitted"{{ $invoice_reminder->pi_submitted==1? 'checked': '' }}> --}}

                                    <label for="pi_submitted" class="form-label">PI Submitted</label>
                                    <input type="checkbox" id="pi_submitted" name="pi_submitted"{{ $invoice_reminder->pi_submitted ? 'checked disabled' : '' }}>
                                    @if ($errors->has('pi_submitted'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pi_submitted') }}</strong>
                                    </span>
                                @endif
                                    </div>
                            </div>
                            <div class="col-md-6 col-12">

                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="pr_number" class="form-label">PR Number</label>
                                    <input type="text"  id="pr_number" name="pr_number" class="form-control p-4" data-role="tagsinput" value="{{$invoice_reminder->pr_number}}"/>
                                </div>
                            </div>

                            @if($invoice_reminder->pi_submitted==true)

                            <hr style="height:2px;border-width:0;color:gray;background-color:#0d6efd;">



                            <div class="col 12 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="ses_migo_date" class="form-label">SES/MIGO Date</label>
                                    <input type="date" class="form-control form-control-sm" id="ses_migo_date" name="ses_migo_date" value="{{ $invoice_reminder->ses_migo_date }}" >
                                </div>
                            </div>
                            <div class="col-md-6 col-12">

                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="invoice_submitted" class="form-label">Invoice Submitted</label>
                                    <input type="checkbox" id="invoice_submitted" name="invoice_submitted" {{ $invoice_reminder->invoice_submitted==1? 'checked disabled': '' }}>

                                    </div>
                            </div>
                            <div class="col-md-6 col-12">

                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="po_number" class="form-label">PO Number</label>
                                    <input id="po_number" name="po_number" type="text" class="form-control p-4" data-role="tagsinput"  value="{{$invoice_reminder->po_number}}"/>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="ses_migo_number" class="form-label">SES/MIGO Number</label>
                                    <input id="ses_migo_number" name="ses_migo_number" type="text" class="form-control p-4" data-role="tagsinput"  value="{{$invoice_reminder->ses_migo_number}}"/>
                                </div>
                            </div>


                            <div class="col-md-6 col-12">

                            </div>
                            @elseif($invoice_reminder->pi_submitted==false)

                            @else

                            @endif

                         @if($invoice_reminder->invoice_submitted==true)

                            <hr  style="height:2px;border-width:0;color:gray;background-color:#0d6efd;">


                            <div class="col 12 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="due_date" class="form-label">Due Date</label>
                                    <input type="date" class="form-control form-control-sm" id="due_date" name="due_date" value="{{ $invoice_reminder->due_date }}" >
                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="finance_status" class="form-label">Finance Status</label>
                                    {{-- <input type="text" class="form-control form-control-sm" id="finance_status" name="finance_status" value="Pending">
                                     --}}
                                     {{-- <select class="form-control form-control-sm" id="finance_status" name="finance_status">
                                        <option value="Pending">MIRO</option>
                                        <option value="MIRO">Clearing</option>
                                        <option value="Done">Done</option>
                                    </select> --}}
                                    <select class="form-control form-control-sm" id="finance_status" name="finance_status">
                                        <option value="MIRO" {{ $invoice_reminder->finance_status == 'MIRO' ? 'selected' : '' }}>MIRO</option>
                                        <option value="Clearing" {{ $invoice_reminder->finance_status == 'Clearing' ? 'selected' : '' }}>Clearing</option>
                                        <option value="Done" {{ $invoice_reminder->finance_status == 'Done' ? 'selected' : '' }}>Done</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                {{-- <div class="form-group">
                                    <label for="invoice_received_date" class="form-label">Invoice Received Date</label>
                                    <input type="date" class="form-control form-control-sm" id="invoice_received_date" name="invoice_received_date" value="">
                                </div> --}}
                            </div>
                            @elseif($invoice_reminder->invoice_submitted==false)

                            @else

                            @endif
                            <div class="m-3">
                            </div>

                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Update Reminder</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
      </div>
    </div>
  </div>


<script  type="text/javascript">

$(document).ready(function() {
    $('#pi_submitted').click(function() {
        if ($(this).is(':checked')) {
            // Display a modal
            $('#myModal').modal('show');
        }
    });

    $('#submitEmail').click(function() {
        // Get the email and CC values from the modal inputs
        var email = $('#email').val();
        var cc = $('#cc').val();

        // Perform email sending logic here (example using AJAX)
        $.ajax({
            url: 'send-email.php', // Replace with your server-side email sending endpoint
            method: 'POST',
            data: {
                email: email,
                cc: cc
            },
            success: function(response) {
                // Email sent successfully, disable the checkbox
                $('#pi_submitted').prop('disabled', true);
                // Close the modal
                $('#myModal').modal('hide');
            },
            error: function(xhr, status, error) {
                // Handle error if email sending fails
                console.error(error);
            }
        });
    });
});
</script>
  <script   type="text/javascript">

  </script>

{{-- script tag input --}}
<script type='text/javascript'>
// http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/

$(document).ready(function() {

$('input[name="tag_input"]').tagsinput({
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


<script type='text/javascript'>
$('#add_row_pr').click(function(event) {
    event.preventDefault(); // Prevent form submission
  //Add row
  row = '';
  row += '<tr><td><input type="text" class="form-control"></td><td ><input type="text" class="form-control"></td><td><input type="text" class="form-control"></td><td><input type="number" class="form-control"></td>';
  row += '<td><button class="btn btn-outline-danger delete_row">remove</button></td></tr>';
  $("#add_table_pr tbody").append(row);
})
$('#add_row_po').click(function(event) {
    event.preventDefault(); // Prevent form submission
  //Add row
  row = '';
  row += '<tr><td><input type="text" class="form-control"></td><td ><input type="date" class="form-control"></td><td><input type="date" class="form-control"></td><td><input type="number" class="form-control"></td>';
  row += '<td><button class="btn btn-outline-danger delete_row">remove</button></td></tr>';
  $("#add_table_po tbody").append(row);
})
$('#add_row_ses').click(function(event) {
    event.preventDefault(); // Prevent form submission
  //Add row
  row = '';
  row += '<tr><td><input type="text" class="form-control"></td><td ><input type="date" class="form-control"></td><td><input type="date" class="form-control"></td><td><input type="number" class="form-control"></td>';
  row += '<td><button class="btn btn-outline-danger delete_row">remove</button></td></tr>';
  $("#add_table_ses tbody").append(row);
})


$("#add_table_pr").on('click', '.delete_row', function() {
  $(this).closest('tr').remove();
});

$("#add_table_po").on('click', '.delete_row', function() {
  $(this).closest('tr').remove();
});

$("#add_table_ses").on('click', '.delete_row', function() {
  $(this).closest('tr').remove();
});
// Function to add a tag to the tag list
// function addTag(tagName) {
//     const tagList = document.getElementById('tag-list');
//     const tag = document.createElement('span');
//     tag.className = 'tag';
//     tag.textContent = tagName;
//     tagList.appendChild(tag);
// }

// // Function to handle tag input
// function handleTagInput(event) {
//     if (event.key === 'Enter' || event.key === ',') {
//         const tagInput = document.getElementById('tag-input');
//         const tagName = tagInput.value.trim();

//         if (tagName !== '') {
//             addTag(tagName);
//             tagInput.value = '';
//         }
//     }
// }

// // Add event listener for tag input
// const tagInput = document.getElementById('tag-input');
// tagInput.addEventListener('keyup', handleTagInput);
//         </script>

@endsection
