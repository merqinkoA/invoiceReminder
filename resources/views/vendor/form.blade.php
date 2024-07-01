<div class="modal fade" id="modal-form" tabindex="1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
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
                    <input type="hidden" id="id" name="id">


                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Name<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" autofocus
                                        required>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Vendor SAP ID</label>
                                    <input type="text" class="form-control" id="vendor_sap_id" name="vendor_sap_id"
                                        autofocus>
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>

                            {{--
                        <div class="form-group">
                            <label >Address</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"   required>
                            <span class="help-block with-errors"></span>
                        </div> --}}
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="text" class="form-control" id="website" name="website">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            {{-- <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control" id="company_name" name="company_name" required><a
                                onclick="addCompanies(' . $invoiceReminders->ir_id . ')"
                                class="btn btn-primary btn-xs"><i class="bi bi-plus"></i></a>
                            <span class="help-block with-errors"></span>
                        </div> --}}<div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" id="address" name="address">
                                    <span class="help-block with-errors"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Address SAP</label>
                                    <input type="text" class="form-control" id="address_sap" name="address_sap">
                                    <span class="help-block with-errors"></span>
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

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-danger pull-left" data-bs-dismiss="modal">Cancel</button>
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
