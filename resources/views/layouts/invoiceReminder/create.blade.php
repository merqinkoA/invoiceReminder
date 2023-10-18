@extends('layouts.temp_index')

@section('content')
    {{-- <div class="panel panel-default">
        <div class="panel-body">
            <p style="font-size:20px; font-weight:bold;">Create New Employee</p>
            <form action="" method="POST">
                @csrf
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('joining_date') ? ' has-error' : '' }}">
                    <label for="joining_date">Joining date</label>
                    <input type="date" name="joining_date" id="joining_date" class="form-control">

                    @if ($errors->has('joining_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('joining_date') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('joining_salary') ? ' has-error' : '' }}">
                    <label for="joining_salary">Joining salary</label>
                    <input type="number" name="joining_salary" id="joining_salary" class="form-control">

                    @if ($errors->has('joining_salary'))
                        <span class="help-block">
                            <strong>{{ $errors->first('joining_salary') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }}">
                    <label for="is_active">Active</label><br>
                    <input type="checkbox" name="is_active" id="is_active" value="1">
                    @if ($errors->has('is_active'))
                        <span class="help-block">
                            <strong>{{ $errors->first('is_active') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Create Employee</button>
            </form>
        </div>
    </div> --}}



    <div class="container">
        <div class="row justify-content-center">
          <div class="col-6 col-md-12">

      <div class="card">
        <div class="card-header">
            <h5 class="card-title"> Invoice Reminder</h5>
             {{-- <button type="button" class="btn icon icon-left btn-primary block" data-bs-toggle="modal"
            data-bs-target="#createNew">
            <i data-feather="edit"></i> create new
        </button> --}}

        {{-- <a href="#" class="btn icon icon-left btn-primary"><i data-feather="edit"></i> Primary</a> --}}
    <!-- Vertically Centered modal Modal -->

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
                    <form action="{{ route('invoiceReminder.store') }}" id="insertForm" method="POST" class="form">
                        @csrf
                        <div class="row">


                            <div class="col-md-2 ">
                                <div class="form-group">
                                    <label for="invoice_number" class="form-label">Invoice Number</label>
                                         </div>
                            </div>

                            <div class="col-md-4 ">
                                <div class="form-group">
                                            <input type="number" class="form-control form-control-sm" id="invoice_number" name="invoice_number" required>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <input type="number" class="form-control form-control-sm" id="invoice_number" name="invoice_number" value="">

                            </div>



                            {{-- <div class="col-md-4">
                                <div class="form-group">

                                    <input type="text" class="form-control form-control-sm" id="supplier_name" name="supplier_name" value="" >
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="supplier_name">Select Supplier:</label>
                                <select name="supplier_name" id="supplier_name" class="choices form-select" >
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">{{ $vendor->name }} ({{$vendor->company_name}})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                            <div class="col-md-6 ">

                            </div>




                            <div class="col-md-2 col-12">
                            <div class="form-group">
                                <label for="currency">Currency</label>

                            </div>
                        </div>
                        <div class="col-md-2 col-12">
                            <div class="form-group">
                                <select name="currency" id="currency" class="form-control">
                                    <option value="USD">USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="GBP">GBP</option>
                                    <!-- Add more currency options as needed -->
                                </select>
                            </div>
                        </div>

                        <div class="col-md-8 col-12">

                        </div>

                            <div class="col-md-2 col-12">
                                <div class="form-group">
                                    <label for="net_value" class="form-label">Net Value</label>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm" id="net_value" name="net_value" value="" >
                                </div>
                            </div>
                            <div class="col-md-8 col-12">

                            </div>

                            {{-- <div class="col-12 col-md-8 offset-md-4 form-group">
                                <div class='form-check'>
                                    <div class="checkbox">
                                        <input type="checkbox" id="checkbox1" class='form-check-input'
                                            checked>
                                        <label for="checkbox1">Remember Me</label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="pr_number" class="form-label">PR Number</label>
                                    <input type="text"  id="pr_number" name="pr_number" class="form-control p-4" data-role="tagsinput" />
                                </div>
                            </div>

                            <div class="col-md-8 col-12">

                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">

                                    <input type="checkbox" id="pi_submitted" name="pi_submitted" >
                                    <label for="pi_submitted" class="form-label">PI Submitted</label>
                                    </div>
                            </div>

{{--
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="po_number" class="form-label">PO Number</label>
                                    <input type="number" class="form-control form-control-sm" id="po_number" name="tag_input" value="{{ $lastRecordPRNumber }}" readonly required>
                                </div>
                            </div> --}}

                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                        </div>
                    </form>


                </div>

            </div>
        </div>
      </div>
    </div>
    {{-- <script src="{{asset('assets')}}/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{asset('assets')}}/js/pages/form-element-select.js"></script> --}}
    <script type='text/javascript'>
        // http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/examples/

        $(document).ready(function() {

        $('input[name="pr_number"]').tagsinput({
            trimValue: true,
            confirmKeys: [13, 44, 32],
            focusClass: 'my-focus-class'
        });

        $('.bootstrap-tagsinput input').on('focus', function() {
            $(this).closest('.bootstrap-tagsinput').addClass('has-focus');
        }).on('blur', function() {
            $(this).closest('.bootstrap-tagsinput').removeClass('has-focus');
        });

        });
        </script>
@endsection
