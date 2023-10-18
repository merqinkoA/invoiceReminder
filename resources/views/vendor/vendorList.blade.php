@extends('layouts.temp_index')

@yield('addModal')

@section('content')

<div class="card">
    <div class="card-header">
      <h5>Vendor List</h5>
       <button type="button" class="btn icon icon-left btn-primary block" data-bs-toggle="modal"
       data-bs-target="#addVendorModal">
       <i data-feather="user-plus"></i> Add New
   </button>
    </div>
    <div class="card-body">
        <table class="table" id="table1">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Company</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($Vendors as $vdata)
                    <tr>
                        <td>

                            {{-- <a href="javascript:void(0)" data-toggle="tooltip" data-pr_number="{{ $data->pr_number }}" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="bi bi-pencil"></i></a> --}}
                            {{-- <a href="javascript:void(0)" data-toggle="tooltip" data-pr_number="" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="bi bi-trash"></i></a>
                            <form method="post" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-original-title="Send Email"><i class="bi bi-envelope"></i> {{ $vdata->Name }}</button>
                            </form> --}}

                            <form action="{{ route('vendor.destroy',$vdata->id) }}" method="Post">

                                <a class="btn btn-primary" href="{{ route('vendor.edit',$vdata->id) }}"><i class="bi bi-pencil"></i></a>

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                        <td>{{ $vdata->name }}</td>
                        <td>{{ $vdata->email }}</td>
                        <td>{{ $vdata->company_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop
