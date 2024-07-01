<?php

namespace App\Http\Controllers;

use App\Models\InvoiceReminder;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class VendorController extends Controller
{
    public function __construct()
    {
        // $this->middleware = new Middleware
    }
    /**
     * Display a listing of the resource.
     */

    public function getVendorEmails(Request $request)
    {
        $query = $request->input('q');

        $emails = Vendor::where('email', 'like', "%$query%")->get(['id', 'email']);

        return response()->json($emails);
    }
    public function index(Request $request)
    {
        $Vendors = Vendor::all();
        $invoiceReminders = InvoiceReminder::all();
        return view('vendor.index', compact('Vendors', 'invoiceReminders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'vendor_sap_id' => 'nullable|string',
            'name' => 'nullable|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'website' => 'nullable|string',
            'address' => 'nullable|string',
            'address_sap' => 'nullable|string',
        ]);
        vendor::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Vendor Created'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vendors = Vendor::find($id);
        return $vendors;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'nullable|string',
            'email' => 'nullable',
            'company_name' => 'nullable|string',
        ]);

        $vendors = Vendor::findOrFail($id);

        $vendors->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Vendor Updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Vendor::destroy($id);

        return response()->json([
            'success' => true,
            'message' => 'Vendor Data Deleted',
        ]);
    }

    public function apiVendor()
    {
        $vendors = Vendor::all();

        return Datatables::of($vendors)
            ->addColumn('vendor_name', function ($vendors) {
                // Fetch the company name based on the supplier_name
                $vendor = Vendor::find($vendors->id);
                return $vendor ? $vendor->vendor_sap_id . ' - ' . $vendor->name : '';
            })
            ->addColumn('action', function ($vendors) {
                return '<a onclick="editForm(' . $vendors->id . ')" class="btn btn-primary btn-xs"><i class="bi bi-pencil"></i></a> ' .
                    '<a onclick="deleteData(' . $vendors->id . ')" class="btn btn-danger btn-xs"><i class="bi bi-trash"></i></a>';
            })
            ->rawColumns(['action'])->make(true);
    }
}
