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
          <div class="col-md-6">

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
                    <form action="{{ route('invoiceReminder.store') }}" id="insertForm" method="POST" class="form">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="pr_number" class="form-label">Invoice Number</label>
                                    <input type="number" class="form-control form-control-sm" id="pr_number" name="pr_number" value="{{ $lastRecordPRNumber }}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="pr_number" class="form-label">PR Number</label>
                                    <input type="number" class="form-control form-control-sm" id="pr_number" name="pr_number" value="{{ $lastRecordPRNumber }}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="supplier_name" class="form-label">Supplier Name</label>
                                    <input type="text" class="form-control form-control-sm" id="supplier_name" name="supplier_name" value="" >
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="pr_type" class="form-label">PR Type</label>
                                    <input type="text" class="form-control form-control-sm" id="pr_type" name="pr_type" value="">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="pr_approved" class="form-label">PI Approved</label>
                                    <input type="checkbox" class="form-check-input" id="pr_approved" name="pr_approved">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="po_number" class="form-label">PO Number</label>
                                    <input type="number" class="form-control form-control-sm" id="po_number" name="po_number" value="">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="invoice_date" class="form-label">Invoice Date</label>
                                    <input type="date" class="form-control form-control-sm" id="invoice_date" name="invoice_date" value="">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="invoice_received_date" class="form-label">Invoice Received Date</label>
                                    <input type="date" class="form-control form-control-sm" id="invoice_received_date" name="invoice_received_date" value="">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="bast_status" class="form-label">Invoice Submitted</label>
                                    <input type="checkbox" class="form-check-input" id="bast_status" name="" >
                                </div>
                            </div>

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
                                        <option value="pending">Pending</option>
                                        <option value="MIRO">MIRO</option>
                                        <option value="Done">Done</option>
                                    </select>
                                </div>
                            </div>
                            <div class="m-3">
                                <table id="add_table_pr" class="table" data-toggle="table" data-mobile-responsive="true">
                                  <thead>
                                    <tr>
                                      <th>PR Number</th>
                                      <th>test2</th>
                                      <th>test3</th>
                                      <th>...</th>
                                      <th>
                                        <button class="btn btn-outline-success" id="add_row_pr" class="add"> add
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
                              </div>
                              <div class="m-3">
                                <table id="add_table_po" class="table" data-toggle="table" data-mobile-responsive="true">
                                  <thead>
                                    <tr>
                                      <th>PO Number</th>
                                      <th>test2</th>
                                      <th>test3</th>
                                      <th>...</th>
                                      <th>
                                        <button class="btn btn-outline-success" id="add_row_po" class="add"> add
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
                              </div>
                              <div class="m-3">
                                <table id="add_table_ses" class="table" data-toggle="table" data-mobile-responsive="true">
                                  <thead>
                                    <tr>
                                      <th>SES/MIGO</th>
                                      <th>test2</th>
                                      <th>test3</th>
                                      <th>...</th>
                                      <th>
                                        <button class="btn btn-outline-success" id="add_row_ses" class="add"> add
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
                              </div>

                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                    </form>

                    {{-- <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button> --}}
                    {{-- <button type="submit" id="createNewInvoice" class="btn btn-primary ml-1" >
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Accept</span>
                    </button> --}}
                </div>

            </div>
        </div>
      </div>
    </div>
  </div>
  <form action="/submit" method="POST">
    @csrf

    <table>
      <thead>
        <tr>
          <th>PR Number</th>
          <th>PO Number</th>
          <th>SES Number</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><input type="text" name="pr_number[]" /></td>
          <td><input type="text" name="po_number[]" /></td>
          <td><input type="text" name="ses_number[]" /></td>
        </tr>
        <!-- Repeat the above row structure for each data row -->
      </tbody>
    </table>

    <button type="submit">Submit</button>
  </form>
  <form action="/submit" method="POST">
    <label for="dataField">Data Values:</label>
    <textarea name="dataField" rows="4" cols="50"></textarea>
    <button type="submit">Submit</button>
  </form>

  <div class="tag-input">
    <input type="text" id="tag-input" placeholder="Add tags...">
</div>
<div class="tag-list" id="tag-list"></div>
<script src="script.js"></script>
  <script>

$data = $_POST['dataField']; // Retrieve the submitted data
$values = explode(',', $data); // Split the data using comma as the delimiter

// Process the individual values as needed
foreach ($values as $value) {
  // Perform operations on each value
  echo $value . "<br>";
}
    var addButton = document.getElementById("addRowButton");
    var tableBody = document.getElementById("myTable").getElementsByTagName("tbody")[0];
    var rowCount = 2; // Number of existing rows
<form action="/submit" method="POST">
  <label for="dataField">Data Values:</label>
  <textarea name="dataField" rows="4" cols="50"></textarea>
  <button type="submit">Submit</button>
</form>
    addButton.addEventListener("click", function() {
      rowCount++; // Increment row count

      var row = document.createElement("tr");
      var fieldCell = document.createElement("td");
      var valuesCell = document.createElement("td");

      fieldCell.textContent = rowCount;
      valuesCell.textContent = "New Value1, New Value2";

      row.appendChild(fieldCell);
      row.appendChild(valuesCell);

      tableBody.appendChild(row);
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
function addTag(tagName) {
    const tagList = document.getElementById('tag-list');
    const tag = document.createElement('span');
    tag.className = 'tag';
    tag.textContent = tagName;
    tagList.appendChild(tag);
}

// Function to handle tag input
function handleTagInput(event) {
    if (event.key === 'Enter' || event.key === ',') {
        const tagInput = document.getElementById('tag-input');
        const tagName = tagInput.value.trim();

        if (tagName !== '') {
            addTag(tagName);
            tagInput.value = '';
        }
    }
}

// Add event listener for tag input
const tagInput = document.getElementById('tag-input');
tagInput.addEventListener('keyup', handleTagInput);

        </script>
    {{-- @include('layouts.invoiceReminder.modals.edit_modal', compact('lastestPRNumber')) --}}
{{-- <script type="text/javascript">


let InvoiceCounter = 0;

$('#add_invoice').click(function () {
    InvoiceCounter++;

    const invoiceField = `
        <div class="mb-3">
            <label for="employees[${InvoiceCounter}][name]" class="form-label">Employee Name</label>
            <input type="text" class="form-control" name="employees[${InvoiceCounter}][name]">
            <label for="employees[${InvoiceCounter}][email]" class="form-label">Employee Email</label>
            <input type="text" class="form-control" name="employees[${InvoiceCounter}][email]">
            <button type="button" class="btn btn-danger" onclick="removeEmployeeField(this)">Remove</button>
        </div>
    `;

    $('#tbody').append(invoiceField);

});

function removeEmployeeField(button) {
    $(button).parent().remove();
}
</script> --}}
@endsection
