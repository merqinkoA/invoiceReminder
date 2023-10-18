
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script><script src="{{asset('assets')}}/js/app.js"></script> --}}
{{-- <script src="{{asset('assets')}}/extensions/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script> --}}
<!-- <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> -->
{{-- <script src="{{asset('assets')}}/js/pages/datatables.js"></script>
<script src="{{asset('assets')}}/extensions/parsleyjs/parsley.min.js"></script>
<script src="{{asset('assets')}}/js/pages/parsley.js"></script>
--}}


  <script src="{{asset('assets')}}/js/bootstrap.js"></script>
    <script src="{{asset('assets')}}/js/app.js"></script>

<script src="{{asset('assets')}}/extensions/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{asset('assets')}}/js/pages/datatables.js"></script>


<script src="{{asset('assets')}}/extensions/toastify-js/src/toastify.js"></script>
{{-- <script src="assets/js/pages/toastify.js"></script> --}}
{{-- {!! Toastr::message() !!} --}}

<script  type="text/javascript">

$(document).ready(function() {



$("#add_table").on('click', '.delete_row', function() {
  $(this).closest('tr').remove();
});

});


</script>
<script type="text/javascript">


    $(window).on('load', function() {
      // Hide the loader once the page and its assets have finished loading
      $('.loader').fadeOut('slow');
    });
    </script>
<script type="text/javascript">

// Get the CSRF token from the meta tag
var csrfToken = $('meta[name="csrf-token"]').attr('content');
var table = $('#tableInvoiceReminder').DataTable({
    "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ]
  });

// $('body').on('click', '.editProduct', function () {

//     var pr_number = $(this).data('pr_number');
//     $.get("/invoiceReminder/" + pr_number + "/edit", function (data) {


//         // Handle the edit operation
//     });
// });
const form = document.getElementById('insertForm');
$('.editInvoice').on('click', function() {

    // Example usage: Change the form action when a button is clicked


//     var button = $(this);
//     var id = button.data('id');
//     var prNumber = button.data('pr-number');
//     var supplierName = button.data('supplier-name');
//     var prType = button.data('pr-type');
//     var prApproved = button.data('pr-approved');
//     var poNumber = button.data('po-number');
//     var invoiceDate = button.data('invoice-date');
//     var invoiceReceivedDate = button.data('invoice-received-date');
//     var bastStatus = button.data('bast-status');
//     var invoiceSubmissionDeadline = button.data('invoice-submission-deadline');
//     var invoiceSubmittedDate = button.data('invoice-submitted-date');
//     var financeReminder = button.data('finance-reminder');
//     var financeStatus = button.data('finance-status');
//     // Set the values in the modal form
//     $('#editId').val(id);
//     $('#pr_number').val(prNumber);
//     $('#supplier_name').val(supplierName);
//     $('#pr_type').val(prType);
//     $('#pr_approved').prop('checked', prApproved);
//     $('#po_number').val(poNumber);
//     $('#invoice_date').val(invoiceDate);
//     $('#invoice_received_date').val(invoiceReceivedDate);
//     $('#bast_status').prop('checked', bastStatus);
//     $('#invoice_submission_deadline').val(invoiceSubmissionDeadline);
//     $('#invoice_submitted_date').val(invoiceSubmittedDate);
//     $('#finance_reminder').val(financeReminder);
//     $('#finance_status').val(financeStatus);
//       // Update the data using AJAX


// });


    var button = $(this);
    var id = button.data('id');
    var prNumber = button.data('pr-number');
    var supplierName = button.data('supplier-name');
    var prType = button.data('pr-type');
    var prApproved = button.data('pr-approved');
    var poNumber = button.data('po-number');
    var invoiceDate = button.data('invoice-date');
    var invoiceReceivedDate = button.data('invoice-received-date');
    var bastStatus = button.data('bast-status');
    var invoiceSubmissionDeadline = button.data('invoice-submission-deadline');
    var invoiceSubmittedDate = button.data('invoice-submitted-date');
    var financeReminder = button.data('finance-reminder');
    var financeStatus = button.data('finance-status');
    // Set the values in the modal form
    $('#editId').val(id);
    $('#editPrNumber').val(prNumber);
    $('#editSupplierName').val(supplierName);
    $('#editPrType').val(prType);
    $('#editPrApproved').prop('checked', prApproved);
    $('#editPoNumber').val(poNumber);
    $('#editInvoiceDate').val(invoiceDate);
    $('#editInvoiceReceivedDate').val(invoiceReceivedDate);
    $('#editBastStatus').prop('checked', bastStatus);
    $('#editInvoiceSubmissionDeadline').val(invoiceSubmissionDeadline);
    $('#editInvoiceSubmittedDate').val(invoiceSubmittedDate);
    $('#editFinanceReminder').val(financeReminder);
    $('#editFinanceStatus').val(financeStatus);
      // Update the data using AJAX

    // $('#editBtn').click(function (e) {
    //     e.preventDefault();
    //     $(this).html('Sending..');
    //     var formData = $(this).serializeArray();
    //         var data = {};
    //         formData.forEach(function (item) {
    //             data[item.name] = item.value;
    //         });
    //     $.ajax({
    //       data: $('#invoiceForm').serialize(),
    //       url: "{{ route('invoiceReminder.update', ['invoiceReminder' => 'YourPrNumber'])}}",
    //       type: "POST",
    //       data: 'json',
    //       success: function (data) {

    //         //   $('#productForm').trigger("reset");
    //           $('#ajaxModel').modal('hide');
    //           table.draw();

    //       },
    //       error: function (data) {
    //           console.log('Error:', data);
    //           $('#editBtn').html('Save Changes');
    //       }
    //   });
    // });
    });

    $('body').on('click', '.deleteProduct', function () {
        var table = $('#tableInvoiceReminder').DataTable();

    var pr_number = $(this).data('pr_number');
    var row = $(this).closest('tr')
    var table = $('#tableInvoiceReminder').DataTable();
    if (confirm("Are you sure you want to delete?")) {
        $.ajax({
            type: "DELETE",
            url: "/invoiceReminder/" + pr_number,
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the request headers
            },
            success: function (data) {

                console.log('Row removed.'); // Add this line for debugging
                // table.draw();
                table.row(row).remove().draw(); // Use row() method to remove the row and then redraw the DataTable

            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
});


</script>



{{-- sidebar sidebar active movement js --}}
<script  type="text/javascript">
$(document).ready(function() {
    $('.sidebar-item').click(function() {
      // Remove active class from previously active item
      $('.sidebar-item.active').removeClass('active');

      // Add active class to clicked item
      $(this).addClass('active');

      // Update the content or functionality associated with the sidebar item

      // Optional: Prevent default link behavior
    //   event.preventDefault();
    });
  });</script>

  {{-- toaster response js --}}
<script  type="text/javascript">


    @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
    @endif


    @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
    @endif


    @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
    @endif


    @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
    @endif


  </script>

