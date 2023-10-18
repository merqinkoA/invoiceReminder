@extends('layouts.temp_index')

@section('content')





    {{-- <div class="m-3">
        <table id="add_table" class="table" data-toggle="table" data-mobile-responsive="true">
          <thead>
            <tr>
              <th>test1</th>
              <th>test2</th>
              <th>test3</th>
              <th>...</th>
              <th>
                <button class="btn btn-outline-success" id="add_row" class="add"> add
                </button>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <input type="text" class="form-control">
              </td>
              <td>
                <input type="text" class="form-control">
              </td>
              <td>
                <input type="text" class="form-control">
              </td>
              <td>
                <input type="number" class="form-control">
              </td>
              <td>
                <button class="btn btn-outline-danger delete_row">remove</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div> --}}

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-6 col-md-12">

      <div class="card">
        <div class="card-header">
            <h5 class="card-title"> Invoice Reminder</h5>
             {{-- <button type="button" class="btn icon icon-left btn-primary block" data-bs-toggle="modal"
            data-bs-target="#createNew">
            <i data-feather="edit"></i> create new
        </button> --}}

        {{-- <a href="#" class="btn icon icon-left btn-primary"><i data-feather="edit"></i> Primary</a> --}}
    <!-- Vertically Centered modal Modal -->

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
                    <form action="{{ route('invoiceReminder.store') }}" id="insertForm" method="POST" class="form">
                        @csrf
                        <div class="row">


                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label for="invoice_number" class="form-label">Invoice Number</label>
                                         </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                            <input type="number" class="form-control form-control-sm" id="invoice_number" name="invoice_number" required>
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

                                    <input type="text" class="form-control form-control-sm" id="supplier_name" name="supplier_name" value="" >
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
                                    <label for="net_value" class="form-label">Net Value</label>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" id="net_value" name="net_value" value="" >
                                </div>
                            </div>
                            <div class="col-md-8 col-12">

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
                                    <input type="text"  id="pr_number" name="tag_input" class="form-control p-4" data-role="tagsinput" value="213,12312,43242,234324,232525,1211"/>
                                </div>
                            </div>
{{--
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="po_number" class="form-label">PO Number</label>
                                    <input type="number" class="form-control form-control-sm" id="po_number" name="tag_input" value="{{ $lastRecordPRNumber }}" readonly required>
                                </div>
                            </div> --}}
                             <div class="row align-items-end">
                            @if($piApproved)

                                <div class="form-group">
                                    <button type="submit" class="btn disabled btn-success me-1 mb-1">PI Submited <i class="bi bi-send-check"></i> </button>
                                </div>


                            @else

                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger me-1 mb-1">PI Submit <i class="bi bi-send"></i></button>
                                </div>


                            @endif
                        </div>
                            {{-- <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="pi_submitted" class="form-label">PI Submitted</label>
                                    <input type="checkbox" class="form-check-input" id="pi_submitted" name="pi_submitted" value='{{$piApproved}}'>
                                </div>
                            </div>
                           {{$invoiceRemindersPR}} --}}
                            <hr style="height:2px;border-width:0;color:gray;background-color:#0d6efd;">
                            {{-- <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="pr_type" class="form-label">PR Type</label>
                                    <input type="text" class="form-control form-control-sm" id="pr_type" name="pr_type" value="">
                                </div>
                            </div> --}}

                            <div class="col 12 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="due_date" class="form-label">Due Date</label>
                                    <input type="date" class="form-control form-control-sm" id="due_date" name="due_date" >
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                {{-- <div class="form-group">
                                    <label for="invoice_received_date" class="form-label">Invoice Received Date</label>
                                    <input type="date" class="form-control form-control-sm" id="invoice_received_date" name="invoice_received_date" value="">
                                </div> --}}
                            </div>
                            <div class="col 12 col-md-6 col-12">
                                <div class="form-group">
                                    <label for="ses_date" class="form-label">SES/MIGO Date</label>
                                    <input type="date" class="form-control form-control-sm" id="ses_date" name="ses_date" >
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                {{-- <div class="form-group">
                                    <label for="invoice_received_date" class="form-label">Invoice Received Date</label>
                                    <input type="date" class="form-control form-control-sm" id="invoice_received_date" name="invoice_received_date" value="">
                                </div> --}}
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="po_number" class="form-label">PO Number</label>
                                    <input id="po_number" name="tag_input" type="text" class="form-control p-4" data-role="tagsinput"  value="213,12312,43242,234324,232525,1211"/>
                                </div>
                            </div>
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label for="ses_number" class="form-label">SES/MIGO Number</label>
                                    <input id="ses_number" name="tag_input" type="text" class="form-control p-4" data-role="tagsinput"  value="213,12312,43242,234324,232525,1211"/>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                {{-- <div class="form-group">
                                    <label for="invoice_received_date" class="form-label">Invoice Received Date</label>
                                    <input type="date" class="form-control form-control-sm" id="invoice_received_date" name="invoice_received_date" value="">
                                </div> --}}
                            </div>

                            {{-- <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="po_number" class="form-label">PO Number</label>
                                    <input type="number" class="form-control form-control-sm" id="po_number" name="po_number" value="">
                                </div>
                            </div> --}}

                            {{-- <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="bast_status" class="form-label">Invoice Submitted</label>
                                    <input type="checkbox" class="form-check-input" id="bast_status" name="" >
                                </div>
                            </div> --}}

                            @if($piApproved)

                            <div class="form-group">
                                <button type="submit" class="btn disabled btn-success me-1 mb-1">Invoice Submited <i class="bi bi-send-check"></i> </button>
                            </div>


                        @else

                            <div class="form-group">
                                <button type="submit" class="btn btn-danger me-1 mb-1">Invoice Submit <i class="bi bi-send"></i></button>
                            </div>


                        @endif

                            <hr  style="height:2px;border-width:0;color:gray;background-color:#0d6efd;">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="invoice_submission_deadline" class="form-label">Due Date</label>
                                    <input type="date" class="form-control form-control-sm" id="invoice_submission_deadline" name="invoice_submission_deadline" value="">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="invoice_submitted_date" class="form-label">Invoice Submitted Date</label>
                                    <input type="date" class="form-control form-control-sm" id="invoice_submitted_date" name="invoice_submitted_date" value="">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="finance_reminder" class="form-label">Finance Reminder</label>
                                    <input type="number" class="form-control form-control-sm" id="finance_reminder" name="finance_reminder" value="">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="finance_status" class="form-label">Finance Status</label>
                                    {{-- <input type="text" class="form-control form-control-sm" id="finance_status" name="finance_status" value="Pending">
                                     --}}
                                     <select class="form-control form-control-sm" id="finance_status" name="finance_status">
                                        <option value="Pending">MIRO</option>
                                        <option value="MIRO">Clearing</option>
                                        <option value="Done">Done</option>
                                    </select>
                                </div>
                            </div>
                            <div class="m-3">
                            </div>

                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
      </div>
    </div>
  </div>

  {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#conversationModal">
    Open Conversation
  </button>

  <!-- Modal -->
  <div class="modal fade" id="conversationModal" tabindex="-1" aria-labelledby="conversationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="conversationModalLabel">Conversation</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div id="conversationContent">
            <!-- Conversation content goes here -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div> --}}
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

  // Add a click event listener to the checkbox
// document.getElementById("pi_submitted").addEventListener("click", function() {
//     // If the checkbox is checked
//     if (this.checked) {
//         // Show a SweetAlert popup with an email input field
//         Swal.fire({
//             title: "Email Verification",
//             html: '<input type="email" id="email" class="swal2-input" placeholder="Enter your email">',
//             showCancelButton: true,
//             confirmButtonText: "Submit",
//             preConfirm: function() {
//                 // Retrieve the entered email value
//                 const email = Swal.getPopup().querySelector("#email").value;
//                 // Perform email validation or any other logic you need
//                 if (!validateEmail(email)) {
//                     Swal.showValidationMessage("Invalid email address");
//                 } else {
//                     // Email is valid, perform further actions here
//                     // For example, send the email value to the server or display a success message
//                     Swal.fire("Email verified!", "Email: " + email, "success");
//                 }
//             }
//         });
//     }
// });

// // Email validation function
// function validateEmail(email) {
//     // Implement your own email validation logic here
//     // This is a basic example
//     const regex = /\S+@\S+\.\S+/;
//     return regex.test(email);
// }
// http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/

// $(document).ready(function() {

// $('input[name="input"]').tagsinput({
//     trimValue: true,
//     confirmKeys: [13, 44, 32],
//     focusClass: 'my-focus-class'
// });

// $('.bootstrap-tagsinput input').on('focus', function() {
//     $(this).closest('.bootstrap-tagsinput').addClass('has-focus');
// }).on('blur', function() {
//     $(this).closest('.bootstrap-tagsinput').removeClass('has-focus');
// });

// });

// $(document).ready(function() {
//     $('#tags').select2({
//         tags: true, // Allows creating new tags
//         tokenSeparators: [',', ' '], // Define how tags are separated
//     });
// });



// $data = $_POST['dataField']; // Retrieve the submitted data
// $values = explode(',', $data); // Split the data using comma as the delimiter

// // Process the individual values as needed
// foreach ($values as $value) {
//   // Perform operations on each value
//   echo $value . "<br>";
// }
//     var addButton = document.getElementById("addRowButton");
//     var tableBody = document.getElementById("myTable").getElementsByTagName("tbody")[0];
//     var rowCount = 2; // Number of existing rows
// <form action="/submit" method="POST">
//   <label for="dataField">Data Values:</label>
//   <textarea name="dataField" rows="4" cols="50"></textarea>
//   <button type="submit">Submit</button>
// </form>
//     addButton.addEventListener("click", function() {
//       rowCount++; // Increment row count

//       var row = document.createElement("tr");
//       var fieldCell = document.createElement("td");
//       var valuesCell = document.createElement("td");

//       fieldCell.textContent = rowCount;
//       valuesCell.textContent = "New Value1, New Value2";

//       row.appendChild(fieldCell);
//       row.appendChild(valuesCell);

//       tableBody.appendChild(row);
//     });
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
