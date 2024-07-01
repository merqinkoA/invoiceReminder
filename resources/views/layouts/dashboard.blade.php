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

    {{-- @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif --}}
    <div class="panel panel-default">
        <div class="panel-body">
            <strong>Invoice Reminder List</strong>
            <a href="{{ route('invoiceReminder.create') }}" class="btn btn-primary btn-xs pull-right py-0">Create New Reminder</a>
            {{-- {{$now}} --}} <div class="table-responsive">
            <table class="table table-responsive table-bordered table-stripped" id="tableInvoiceReminder" style="margin-top:10px;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice Number</th>
                        <th>Supplier Name</th>
                        <th>Currency</th>
                        <th>PR Number</th>
{{--
                        <th>PI</th>
                        <th>Invoice</th>
                        <th>SES/MIGO date</th>
                        <th>PO Number</th>
                        <th>SES/MIGO Number</th> --}}
                        <th>Action</th>

                </thead>

                <tbody>
                    @foreach ($invoice_reminders as $invoice_reminder)
                    <tr>

                        <td>{{ $invoice_reminder->ir_id }}</td>
                        <td>{{ $invoice_reminder->invoice_number }}</td>
                        <td>
                            @foreach ($vendors as $vendor)
                                @if ($invoice_reminder->supplier_name == $vendor->id)
                                {{ $vendor->name }}  ({{ $vendor->company_name }})
                                @endif
                            @endforeach
                        </td>

                        <td>{{ $invoice_reminder->currency }} {{ number_format($invoice_reminder->net_value, 2, '.', ',') }}</td>
                        <td>
                        @foreach ($invoice_reminder->pr_number ? explode(',', $invoice_reminder->pr_number) : [] as $pr_number)
                        <span class="badge bg-primary">{{ $pr_number }}</span>
                        @endforeach
                        </td>

                        <td>
                            <a href="{{ route('invoiceReminder.show',$invoice_reminder->ir_id) }}" class="btn btn-sm btn-primary btn-xs py-0"><i class="bi bi-zoom-in"></i>
                            </a>
                            <a href="{{ route('invoiceReminder.edit',$invoice_reminder->ir_id) }}" class="btn btn-sm btn-warning btn-xs py-0"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('invoiceReminder.destroy',$invoice_reminder->ir_id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger btn-xs py-0 show_confirm"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

        </div>
    </div>

</div>

</div>
</div>
</div>
</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>


<script type="text/javascript">

    // $(document).ready(function () {
    //     var table = $('#tableInvoiceReminder').DataTable();

    //     // Add a click event listener to the "Toggle" button
    //     $('#tableInvoiceReminder tbody').on('click', 'button.toggle-row', function () {
    //         var tr = $(this).closest('tr');
    //         var row = table.row(tr);

    //         // Toggle the row's visibility
    //         if (row.child.isShown()) {
    //             // This row is open, so close it
    //             row.child.hide();
    //             tr.removeClass('shown');
    //         } else {
    //             // Open this row
    //             row.child(tr.next('.collapsible-row')).show();
    //             tr.addClass('shown');
    //         }
    //     });
    // });
    </script>

<script type="text/javascript">

     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure you want to delete this record?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });

</script>

@endsection
