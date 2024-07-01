<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pic;
use App\Models\Vendor;
use Yajra\DataTables\DataTables;

class PicController extends Controller
{
    public function index()
    {
        $pic = pic::all();
        $vendors = vendor::all();
        return view('pic.index', compact('pic', 'vendors'));
    }

    public function create()
    {
        $vendors = Vendor::all(); // Retrieve all vendors to populate the dropdown
        return view('pic.create', compact('vendors'));
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        //     'vendor_id' => 'required|exists:vendors,id', // Validate the existence of vendor_id in the vendors table
        //     'email' => 'nullable|email',
        //     'phone' => 'nullable',
        //     'address' => 'nullable',
        //     'role' => 'nullable|exists:roles,id',
        //     'website' => 'nullable|string',
        //     // Add other validation rules for additional fields
        // ]);

        // pic::create($request->all());
        $validatedData = $request->validate([
            'name' => 'required',
            'vendor_id' => 'required|exists:vendors,id',
            'email' => 'required|email|unique:pic,email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'role_id' => 'required',
            'website' => 'nullable|',
        ]);

        $pic = Pic::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Pic created successfully'
        ]);
        // return redirect()->route('pis.index')->with('success', 'Pic created successfully');
    }

    public function show($id)
    {
        $pic = pic::findOrFail($id);
        return view('pic.show', compact('pic'));
    }

    public function edit($id)
    {
        $pic = pic::findOrFail($id);
        $vendors = Vendor::all(); // Retrieve all vendors to populate the dropdown
        // return view('pic.edit', compact('pic', 'vendors'));
        return $pic;
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'vendor_id' => 'required|exists:vendors,id', // Validate the existence of vendor_id in the vendors table
            'email' => 'nullable|email',
            'phone' => 'nullable',
            'address' => 'nullable',
            'role' => 'nullable',
            'website' => 'nullable|string',
            // Add other validation rules for additional fields
        ]);

        $pic = pic::findOrFail($id);
        $pic->update($request->all());

        // return redirect()->route('pic.index')->with('success', 'Pic updated successfully');
        return response()->json([
            'success' => true,
            'message' => 'Pic updated successfully',
        ]);
    }

    public function destroy($id)
    {
        $pic = pic::findOrFail($id);
        $pic->delete();

        return redirect()->route('pic.index')->with('success', 'Pic deleted successfully');
    }
    public function apiPic()
    {
        $picList = pic::all();

        return Datatables::of($picList)
            ->addColumn('vendor_name', function ($picList) {
                // Fetch the company name based on the supplier_name
                $vendor = Vendor::find($picList->vendor_id);
                return $vendor ? $vendor->name : '';
            })
            ->addColumn('role_name', function ($picList) {
                // Use a ternary operator to set the role name based on role_id
                return $picList->role_id == 1 ? 'AM' : ($picList->role_id == 2 ? 'PIC' : '');
            })
            ->addColumn('action', function ($picList) {
                return '<a onclick="editForm(' . $picList->id . ')" class="btn btn-primary btn-xs"><i class="bi bi-pencil"></i></a> ' .
                    '<a onclick="deleteData(' . $picList->id . ')" class="btn btn-danger btn-xs"><i class="bi bi-trash"></i></a>';
            })
            ->rawColumns(['action'])->make(true);
    }



    public function getPICEmails()
    {
        $emails = pic::pluck('email'); // Assuming 'email' is the field in PIC model
        return response()->json(['emails' => $emails]);
    }

    // public function apiInvoiceReminder()
    // {
    //     $invoiceReminders = invoice_reminder::all();

    //     return Datatables::of($invoiceReminders)
    //         ->addColumn('supplier_name', function ($invoiceReminders) {
    //             // Fetch the company name based on the supplier_name
    //             $vendor = Vendor::find($invoiceReminders->supplier_name);
    //             return $vendor ? $vendor->company_name : '';
    //         })
    //         ->addColumn('vendor_info', function ($invoiceReminders) {
    //             // Fetch the vendor info based on the supplier_name
    //             $vendor = Vendor::find($invoiceReminders->supplier_name);
    //             return $vendor ? $vendor->name . ' (' . $vendor->company_name . ')' : '';
    //         })
    //         ->addColumn('action', function ($invoiceReminders) {
    //             return '<a onclick="editForm(' . $invoiceReminders->ir_id . ')" class="btn btn-primary btn-xs"><i class="bi bi-pencil"></i></a> ' .
    //                 '<a onclick="deleteData(' . $invoiceReminders->ir_id . ')" class="btn btn-danger btn-xs"><i class="bi bi-trash"></i></a>';
    //         })
    //         ->rawColumns(['action'])->make(true);
    // }
}
