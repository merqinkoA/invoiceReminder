<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Purchase Requisition Form</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                    <label for="pr_number" class="form-label">PR Number</label>
                                                                <input type="text" class="form-control" id="pr_number"
                                                                    name="pr_number" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="supplier_name" class="form-label">Supplier
                                                                    Name</label>
                                                                <input type="text" class="form-control" id="supplier_name"
                                                                    name="supplier_name" required>
                                                                  </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <h6>PR Type</h6>
                                                    <select class="form-select " id="pr_type">
                                                        <option>Contract</option>
                                                        <option>Spot</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="pr_number" class="form-label">PO Number</label>
                                                    <input type="text" class="form-control" id="po_number"
                                                        name="pr_number" required>
                                                      </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="invoice_date" class="form-label">Invoice Date</label>
                                                    <input type="date" class="form-control" id="invoice_date"
                                                        name="invoice_date" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label for="deadline_submission" class="form-label">Deadline
                                                        Submission</label>
                                                    <input type="date" class="form-control" id="deadline_submission"
                                                        name="deadline_submission" required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group col-12">
                                                <div class='form-check'>
                                                  
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            id="flexSwitchCheckChecked" >
                                                        <label class="form-check-label"
                                                            for="flexSwitchCheckChecked">Approved</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>