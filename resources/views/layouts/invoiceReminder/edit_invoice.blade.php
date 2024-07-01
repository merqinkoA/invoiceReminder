@extends('layouts.temp_index')


@section('content')

<div class="card">
    <div class="card-header">

        <div class="card-body">
            <div class="table-responsive">
                <div class="alert alert-danger" style="display:none"></div>
                <form action="{{ route('invoiceReminder.update', $invoiceReminder->pr_number )}}" id="insertForm" method="POST" class="form">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="pr_number" class="form-label">PR Number</label>
                                <input type="number" class="form-control" id="pr_number" name="pr_number" value="{{ $invoiceReminder->pr_number }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="supplier_name" class="form-label">Supplier Name</label>
                                <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="{{ $invoiceReminder->supplier_name }}" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="pr_type" class="form-label">PR Type</label>
                                <input type="text" class="form-control" id="pr_type" name="pr_type" value="{{ $invoiceReminder->pr_type }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="pr_approved" class="form-label">PR Approved</label>
                                <input type="checkbox" class="form-check-input" id="pr_approved" name="pr_approved" {{ $invoiceReminder->pr_approved==1 ? 'checked': '' }}>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="po_number" class="form-label">PO Number</label>
                                <input type="number" class="form-control" id="po_number" name="po_number" value="{{ $invoiceReminder->po_number }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="invoice_date" class="form-label">Invoice Date</label>
                                <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="{{ $invoiceReminder->invoice_date }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="invoice_received_date" class="form-label">Invoice Received Date</label>
                                <input type="date" class="form-control" id="invoice_received_date" name="invoice_received_date" value="{{ $invoiceReminder->invoice_received_date }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="bast_status" class="form-label">BAST Status</label>
                                <input type="checkbox" class="form-check-input" id="bast_status" name="bast_status" {{ $invoiceReminder->bast_status==1 ? 'checked': '' }}>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="invoice_submission_deadline" class="form-label">Invoice Submission Deadline</label>
                                <input type="date" class="form-control" id="invoice_submission_deadline" name="invoice_submission_deadline" value="{{ $invoiceReminder->invoice_submission_deadline }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="invoice_submitted_date" class="form-label">Invoice Submitted Date</label>
                                <input type="date" class="form-control" id="invoice_submitted_date" name="invoice_submitted_date" value="{{ $invoiceReminder->invoice_submitted_date }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="finance_reminder" class="form-label">Finance Reminder</label>
                                <input type="number" class="form-control" id="finance_reminder" name="finance_reminder" value="{{ $invoiceReminder->finance_reminder }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="finance_status" class="form-label">Finance Status</label>
                                <select class="form-control" id="finance_status" name="finance_status">
                                    <option value="pending" {{ $invoiceReminder->finance_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="MIRO" {{ $invoiceReminder->finance_status == 'MIRO' ? 'selected' : '' }}>MIRO</option>
                                    <option value="done" {{ $invoiceReminder->finance_status == 'Done' ? 'selected' : '' }}>Done</option>
                                </select>
                            </div>

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
{{-- @include('layouts.javascripts') --}}


{{-- @push('custom-scripts')


<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/app.js"></script>

<script src="assets/extensions/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="assets/js/pages/datatables.js"></script>


<script src="assets/extensions/toastify-js/src/toastify.js"></script>
@endpush --}}

@endsection

