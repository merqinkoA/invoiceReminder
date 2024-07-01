

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Row</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div><button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <i data-feather="x"></i>
</button>
            <div class="modal-body">
                <!-- Display the row data in the modal form -->
                <form action="{{ route('invoiceReminder.update', ['pr_number' => $invoiceReminder->pr_number]) }}" id="invoiceForm" method="POST" class="form">
                {{-- <form action="{{ route('invoiceReminder.store') }}" id="invoiceForm"  method="POST" class="form"> --}}
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="editPrNumber">PR Number</label>
                                <input type="text" class="form-control" id="editPrNumber" name="pr_number" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="editSupplierName">Supplier Name</label>
                                <input type="text" class="form-control" id="editSupplierName" name="supplier_name" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="editPrType">PR Type</label>
                                <input type="text" class="form-control" id="editPrType" name="pr_type">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="editPrApproved">PR Approved</label>
                                <input type="checkbox" class="form-check-input" id="editPrApproved" name="pr_approved">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="editPoNumber">PO Number</label>
                                <input type="text" class="form-control" id="editPoNumber" name="po_number">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="editInvoiceDate">Invoice Date</label>
                                <input type="date" class="form-control" id="editInvoiceDate" name="invoice_date">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="editInvoiceReceivedDate">Invoice Receive Date</label>
                                <input type="date" class="form-control" id="editInvoiceReceivedDate" name="invoice_receive_date">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="editBastStatus">BAST Status</label>
                                <input type="checkbox" class="form-check-input" id="editBastStatus" name="bast_status">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="editInvoiceSubmissionDeadline">Invoice Submission Deadline</label>
                                <input type="date" class="form-control" id="editInvoiceSubmissionDeadline" name="invoice_submission_deadline">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="editInvoiceSubmittedDate">Invoice Submitted Date</label>
                                <input type="date" class="form-control" id="editInvoiceSubmittedDate" name="invoice_submitted_date">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="editFinanceReminder">Finance Reminder</label>
                                <input type="text" class="form-control" id="editFinanceReminder" name="finance_reminder">
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="editFinanceStatus">Finance Status</label>
                                <input type="text" class="form-control" id="editFinanceStatus" name="finance_status">
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
