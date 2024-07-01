@extends('layouts.invoiceReminder.modals')
@section('modal')


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
                <form  action="{{ route('store') }}" id="insertForm" method="POST" class="form">
@csrf
<div class="row">
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="pr_number" class="form-label">PR Number</label>
            <input type="number" class="form-control" id="pr_number" name="pr_number" value="{{ $lastRecordPRNumber }}" readonly>

        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="supplier_name" class="form-label">Supplier Name</label>
            <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="" required>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="pr_type" class="form-label">PR Type</label>
            <input type="text" class="form-control" id="pr_type" name="pr_type" value="" >
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="pr_approved" class="form-label">PR Approved</label>
            <input type="checkbox" class="form-check-input" id="pr_approved" name="pr_approved" value="">
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="po_number" class="form-label">PO Number</label>
            <input type="number" class="form-control" id="po_number" name="po_number" value="" >
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="invoice_date" class="form-label">Invoice Date</label>
            <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="" >
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="invoice_received_date" class="form-label">Invoice Received Date</label>
            <input type="date" class="form-control" id="invoice_received_date" name="invoice_received_date" value="">
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="bast_status" class="form-label">BAST Status</label>
            <input type="checkbox" class="form-check-input" id="bast_status" name="bast_status" value="">
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="invoice_submission_deadline" class="form-label">Invoice Submission Deadline</label>
            <input type="date" class="form-control" id="invoice_submission_deadline" name="invoice_submission_deadline" value="" >
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="invoice_submitted_date" class="form-label">Invoice Submitted Date</label>
            <input type="date" class="form-control" id="invoice_submitted_date" name="invoice_submitted_date" value="">
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="finance_reminder" class="form-label">Finance Reminder</label>
            <input type="number" class="form-control" id="finance_reminder" name="finance_reminder" value="">
        </div>
    </div>
    <div class="col-md-6 col-12">
        <div class="form-group">
            <label for="finance_status" class="form-label">Finance Status</label>
            <input type="text" class="form-control" id="finance_status" name="finance_status" value="">
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

@stop
