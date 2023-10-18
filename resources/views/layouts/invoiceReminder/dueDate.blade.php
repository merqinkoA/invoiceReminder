@extends('layouts.temp_index')
@section('content')

<div class="card">
    <div class="card-header">
  Invoice Reminder List
        <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
        data-bs-target="#exampleModalCenter">
        create new
    </button>
    </div>

<!-- Vertically Centered modal Modal -->


    <div class="card-body">
        <div class="table-responsive">
        <table class="table compact" id="tableInvoiceReminder" style="width:100%" >
            <thead>
                <tr>
                    <th>Action</th>
                    <th>PR Number</th>
                    <th>Supplier Name</th>
                    <th>PR Type</th>
                    <th>PR Approved</th>
                    <th>PO Number</th>
                    <th>Invoice Date</th>
                    <th>Invoice Receive Date</th>
                    <th>BAST Status</th>
                    <th>Invoice Submission Deadline</th>
                    <th>invoice Submitted Date</th>
                    <th>Finance Reminder</th>
                    <th>Finance Status</th>
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
                    <td><span type="button" class="btn rounded-pill btn-{{ $data->pr_approved ? 'success' : 'danger' }} btn-xs py-0 small">{{ $data->pr_approved ? 'Approved' : 'Pending' }}</span></td>
                    <td>{{ $data->po_number }}</td>
                    <td>{{ $data->invoice_date }}</td>
                    <td>{{ $data->invoice_received_date }}</td>

                    <td><span type="button" class="btn rounded-pill btn-{{ $data->bast_status ? 'success' : 'danger' }} btn-xs py-0 small">{{ $data->bast_status ? 'Approved' : 'Pending' }}</span></td>
                    <td>{{ $data->invoice_submission_deadline }}</td>
                    <td>{{ $data->invoice_submitted_date }}</td>
                    <td>{{ $data->finance_reminder }}</td>
                   <td> @if($data->finance_status == 'Done')
                    <span type="button" class="btn rounded-pill btn-xs py-0  btn-success small">Done</span>
                    @elseif($data->finance_status == 'MIRO')
                        <span type="button" class="btn rounded-pill btn-xs py-0  btn-primary small">MIRO</span>
                    @elseif($data->finance_status == 'Pending')
                        <span type="button" class="btn rounded-pill btn-xs py-0  btn-danger small">Pending</span>
                    @else
                        <span type="button" class="btn rounded-pill btn-xs py-0  btn-dark small">Unknown</span>
                    @endif
                </td>  </tr>
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
