@extends('layouts.temp_index')
@section('content')

@extends('layouts.temp_index')
@section('content')

<div class="card">
    <div class="card-header">
        Due Date List
        <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
        data-bs-target="#exampleModalCenter">
        create new
    </button>
    </div>

<!-- Vertically Centered modal Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Vertically Centered
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                    <form  action="{{ route('dueDate.store') }}" id="insertForm" method="POST" class="form">
    @csrf
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="pr_number" class="form-label">PR Number</label>
                <input type="number" class="form-control" id="pr_number" name="pr_number" value="" required>

            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="supplier_name" class="form-label">Supplier Name</label>
                <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="Test Supplier" required>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="pr_type" class="form-label">PR Type</label>
                <input type="text" class="form-control" id="pr_type" name="pr_type" value="Contract" >
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="pr_approved" class="form-label">PR Approved</label>
                <input type="checkbox" class="form-check-input" id="pr_approved" name="pr_approved" value="true">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="po_number" class="form-label">PO Number</label>
                <input type="number" class="form-control" id="po_number" name="po_number" value="54321" >
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="invoice_date" class="form-label">Invoice Date</label>
                <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="2023-08-28" >
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="invoice_received_date" class="form-label">Invoice Received Date</label>
                <input type="date" class="form-control" id="invoice_received_date" name="invoice_received_date" value="2023-08-28">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="bast_status" class="form-label">BAST Status</label>
                <input type="checkbox" class="form-check-input" id="bast_status" name="bast_status" value="0">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="invoice_submission_deadline" class="form-label">Invoice Submission Deadline</label>
                <input type="date" class="form-control" id="invoice_submission_deadline" name="invoice_submission_deadline" value="2023-09-15" >
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="invoice_submitted_date" class="form-label">Invoice Submitted Date</label>
                <input type="date" class="form-control" id="invoice_submitted_date" name="invoice_submitted_date" value="2023-09-14">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="finance_reminder" class="form-label">Finance Reminder</label>
                <input type="number" class="form-control" id="finance_reminder" name="finance_reminder" value="2">
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div class="form-group">
                <label for="finance_status" class="form-label">Finance Status</label>
                <input type="text" class="form-control" id="finance_status" name="finance_status" value="Pending">
            </div>
        </div>
        {{-- <div class="col-12 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
        </div> --}}
    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary"
                    data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="submit" id="createNewInvoice" class="btn btn-primary ml-1" >
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                </button>
            </div>
        </form>
        </div>
    </div>
</div>

    <div class="card-body">
        <div class="table-responsive">
        <table class="table compact" id="tableInvoiceReminder" style="width:100%" >
            <thead>
                <tr>
                    <th>PR Number</th>
                    <th>Supplier Name</th>
                    <th>PR Type</th>
                    <th>PR Approved</th>
                    <th>PO Number</th>
                    <th>Invoice Date</th>
                    <th>Invoice Receive Date</th>
                    <th>BAST Status</th>
                    <th>Invoice Submission Deadline</th>
                    <th>Status</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if(count($invoiceRemindersDueDate)>0)
                @foreach ($invoiceRemindersDueDate as $data)
                <tr>
                    <td>
                        <a href="javascript:void(0)" data-toggle="tooltip" data-pr_number="{{ $data->pr_number }}" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="bi bi-pencil"></i></a>
                        <a href="javascript:void(0)" data-toggle="tooltip" data-pr_number="{{ $data->pr_number }}" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="bi bi-trash"></i></a>
                        <form action="{{ route('invoiceReminder.sendEmail', ['pr_number' => $data->pr_number]) }}" method="post" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-original-title="Send Email"><i class="bi bi-envelope"></i> </button>
                        </form>

                    </td>
                    <td>{{ $data->pr_number }}</td>
                    <td>{{ $data->supplier_name }}</td>
                    <td>{{ $data->pr_type }}</td>
                    <td>{{ $data->pr_approved }}</td>
                    <td>{{ $data->po_number }}</td>
                    <td>{{ $data->invoice_date }}</td>
                    <td>{{ $data->invoice_received_date }}</td>
                    <td>{{ $data->bast_status }}</td>
                    <td>{{ $data->invoice_submission_deadline }}</td>
                    <td>{{ $data->invoice_submitted_date }}</td>
                    <td>{{ $data->finance_reminder }}</td>
                    <td>{{ $data->finance_status }}</td>
                </tr>
            @endforeach
            @else
            <td colspan="13" class="text-center"><h4 class="my-4">You have no invoice data has due date yet!! Please create set some..</h4></td>
          @endif
            </tbody>
        </table>

    </div>
</div>
</div>


<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Details</label>
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail" required="" placeholder="Enter Details" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





@stop

@stop
