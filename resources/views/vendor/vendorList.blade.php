@extends('layouts.temp_index')
@section('content')

<div class="card">
    <div class="card-header">
       Vendor List
    </div>
    <div class="card-body">
        <table class="table" id="table1">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Vendor as $data)
                    <tr>
                        <td>

                            {{-- <a href="javascript:void(0)" data-toggle="tooltip" data-pr_number="{{ $data->pr_number }}" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="bi bi-pencil"></i></a> --}}
                            <a href="javascript:void(0)" data-toggle="tooltip" data-pr_number="{{ $data->pr_number }}" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="bi bi-trash"></i></a>
                            <form action="{{ route('invoiceReminder.sendEmail', ['pr_number' => $data->pr_number]) }}" method="post" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-original-title="Send Email"><i class="bi bi-envelope"></i> </button>
                            </form>

                        </td>
                        <td>{{ $data->pr_number }}</td>

                        <td>{{ $data->supplier_name }}</td>
                        <td>{{ $data->pr_type }}</td>
                        <td>{{ $data->pr_approved }}</td>
                        <td>{{ $data->po_number }}</td>
                        <td>{{ $data->invoice_date }}</td>
                        <td>{{ $data->invoice_received_date }}</td>
                        <td>{{ $data->bast_status }}</td>
                        <td>{{ $data->invoice_submission_deadline }}</td>
                        <td>{{ $data->invoice_submitted_date }}</td>
                        <td>{{ $data->finance_reminder }}</td>
                        <td>{{ $data->finance_status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
