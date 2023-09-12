
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script><script src="{{asset('assets')}}/js/app.js"></script> --}}
{{-- <script src="{{asset('assets')}}/extensions/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script> --}}
<!-- <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> -->
{{-- <script src="{{asset('assets')}}/js/pages/datatables.js"></script>
<script src="{{asset('assets')}}/extensions/parsleyjs/parsley.min.js"></script>
<script src="{{asset('assets')}}/js/pages/parsley.js"></script>
--}}


  <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

<script src="assets/extensions/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="assets/js/pages/datatables.js"></script>


<script src="assets/extensions/toastify-js/src/toastify.js"></script>
<script src="assets/js/pages/toastify.js"></script>
{{-- {!! Toastr::message() !!} --}}



<script type="text/javascript">

// Get the CSRF token from the meta tag
var csrfToken = $('meta[name="csrf-token"]').attr('content');
var table = $('#tableInvoiceReminder').DataTable({
    "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ]
  });
$('body').on('click', '.editProduct', function () {
    var pr_number = $(this).data('pr_number');
    $.get("/invoiceReminder/" + product_id + "/edit", function (data) {
        // Handle the edit operation
    });
});

$('body').on('click', '.deleteProduct', function () {
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
                row.remove();
                table.draw();
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

