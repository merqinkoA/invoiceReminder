<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\invoice_reminder;
use App\Models\Vendor;
use App\Models\pr;
use App\Models\pic;
use App\Models\po;
use App\Models\ses;
use App\Models\user;
use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Jobs\SendFirstInvoiceReminderEmail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class InvoiceReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $now = Carbon::now();
        $timezone = Config::get('app.timezone');
        // $vendors = Vendor::all();
        // $vendors = Vendor::select('company_name')->distinct()->get();


        // $vendors = Vendor::select(DB::raw('MIN(id) AS id'), 'company_name')
        //     ->groupBy('company_name')
        //     ->get();

        $picEmails = pic::all();
        $vendorList = Vendor::all();
        $userEmails = user::all();
        $invoice_reminders = invoice_reminder::orderBy('ir_id', 'desc')->get();
        return view('layouts.invoiceReminder.index', compact('invoice_reminders', 'timezone', 'vendorList', 'picEmails', 'userEmails'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $category = company::orderBy('name', 'ASC')
        //     ->get()
        //     ->pluck('name', 'id');
        $vendors = Vendor::all();
        //   return view('invoice_reminders.create');
        return view('layouts.invoiceReminder.create', compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'email_to' => 'nullable|string',
            'email_cc' => 'nullable|string',
            'invoice_number' => 'nullable|string',
            'vendor_id' => 'nullable|string',
            'currency' => 'nullable|string',
            'net_value' => 'nullable|string',
            'pr_number' => 'nullable',
            'ses_migo_date' => 'nullable',
            'po_number' => 'nullable|string',
            'ses_migo_number' => 'nullable|string',
            'due_date' => 'nullable',
            'pi_submitted' => 'nullable|string', // Note: Keep this as string
            'invoice_submitted' => 'nullable|string', // Note: Keep this as string
            'finance_status' => 'nullable|string',
        ]);

        // Create a new Invoice_Reminder instance
        $invoiceReminder = new Invoice_Reminder;
        // $invoiceReminder->email_to = $request->input('email_to') ?? null;
        $invoiceReminder->email_cc = $request->input('email_cc') ?? null;
        $invoiceReminder->invoice_number = $request->input('invoice_number');
        $invoiceReminder->vendor_id = $request->input('vendor_id');
        $invoiceReminder->currency = $request->input('currency');
        $invoiceReminder->net_value = $request->input('net_value');
        $invoiceReminder->pr_number = $request->input('pr_number') ?? null;
        $invoiceReminder->ses_migo_date = $request->input('ses_migo_date');
        $invoiceReminder->po_number = $request->input('po_number');
        $invoiceReminder->ses_migo_number = $request->input('ses_migo_number');
        $invoiceReminder->due_date = $request->input('due_date');
        $invoiceReminder->finance_status = $request->input('finance_status');
        $invoiceReminder->invoice_reminder_at = now();
        $invoiceReminder->reminder_pi_date = now();
        $invoiceReminder->reminder_invoice_date = now();
        $invoiceReminder->reminder_finance_date = now();

        // Convert checkbox values to boolean
        $invoiceReminder->pi_submitted = $request->has('pi_submitted');
        $invoiceReminder->invoice_submitted = $request->has('invoice_submitted');

        // Save the model
        $invoiceReminder->save();

        if ($invoiceReminder->pi_submitted) {
            $invoiceReminder->pi_submitted_at = now();
            $invoiceReminder->save();
        }
        // Check if invoice_submitted is true or checked
        if ($invoiceReminder->invoice_submitted) {
            $invoiceReminder->invoice_submitted_at = now();
            $invoiceReminder->save();
        }
        // $prRows = $request->input('pr_number', []);
        // foreach ($prRows as $key => $prNumber) {
        //     // For each pr_number in the pr_table, create a new Pr model instance and save it
        //     $pr = new Pr;
        //     $pr->invoice_number = $request->input('invoice_number');
        //     $pr->pr_number = $prNumber; // Assuming each row has pr_number field

        //     // Additional fields related to PR table can be populated here as per your requirements

        //     $pr->save();
        // }

        return response()->json([
            'success' => true,
            'message' => 'Invoice Reminder Created'
        ]);
    }


    public function show(invoice_reminder $invoice_reminder)
    {
        //
    }

    public function edit(string $id)
    {
        $vendors = Vendor::all();

        // Load the specific invoice_reminder record by its ID
        $invoice_reminder = invoice_reminder::find($id);
        // $prNumber = pr::pluck('pr_number')->toArray();
        // Format the ses_migo_date field to the mm/dd/yyyy format (if it's a string date)
        if ($invoice_reminder->ses_migo_date) {
            $invoice_reminder->ses_migo_date = Carbon::parse($invoice_reminder->ses_migo_date)->format('Y-m-d');
            // Change 'm/d/Y' to 'mm/dd/yyyy' for your desired date format
        }
        // return view('layouts.invoiceReminder.edit', compact('invoice_reminder', 'vendors'));
        return $invoice_reminder;
    }
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, int $invoice_reminder)
    {

        $validatedData = $request->validate([
            // 'email_to' => 'nullable',
            'email_cc' => 'nullable|string',
            'invoice_number' => 'nullable|string',
            'vendor_id' => 'nullable',
            'currency' => 'nullable|string',
            'net_value' => 'nullable|string',
            'pr_number' => 'nullable',
            'due_date' => 'nullable|date',
            'ses_migo_date' => 'nullable',
            'po_number' => 'nullable|string',
            'ses_migo_number' => 'nullable|string',
            'finance_status' => 'nullable|in:Done,MIRO,Clearing,Unknown',
        ]);

        $invoice_reminder = invoice_reminder::findOrFail($invoice_reminder);
        $invoice_reminder->email_cc = $request->input('email_cc') ?? null;
        $invoice_reminder->pi_submitted = $request->filled('pi_submitted');
        $invoice_reminder->invoice_submitted = $request->filled('invoice_submitted');

        $invoice_reminder->update($request->all());
        if ($invoice_reminder->pi_submitted) {
            $invoice_reminder->pi_submitted_at = now();
            $invoice_reminder->save();
        }
        // Check if invoice_submitted is true or checked
        if ($invoice_reminder->invoice_submitted) {
            $invoice_reminder->invoice_submitted_at = now();
            $invoice_reminder->save();
        }
        return redirect()->route('invoiceReminder.index')->with('success', 'Invoice Reminder updated successfully.');
    }


    public function destroy(Request $request, int $invoice_Reminder)
    {
        $test = invoice_reminder::where('ir_id', $invoice_Reminder)->delete();
        // $invoice_reminder->where('ir_id', $invoice_reminder->ir_id)->update(['delete_status' => 1]);
        // dd($invoice_Reminder);
        // return redirect()->route('invoiceReminder.index')->with('success', 'Invoice Reminder deleted successfully.');
        return response()->json([
            'success' => true,
            'message' => 'Invoice Reminder Data Deleted',
        ]);
    }

    public function apiInvoiceReminder()
    {
        $invoiceReminders = invoice_reminder::all();

        return Datatables::of($invoiceReminders)
            ->addColumn('vendor_name', function ($invoiceReminders) {
                // Fetch the company name based on the vendor
                $vendor = Vendor::find($invoiceReminders->vendor_id);
                return $vendor ? $vendor->name : '';
            })
            ->addColumn('vendor_info', function ($invoiceReminders) {
                // Fetch the vendor info based on the vendor
                $vendor = Vendor::find($invoiceReminders->vendor_id);
                return $vendor ? $vendor->name : '';
            })

            ->addColumn('status', function ($invoiceReminders) {
                $status = '';

                if (!$invoiceReminders->pi_submitted) {
                    $status .= '<i class="bi bi-clipboard" style="color: red;"></i> ';
                } else {
                    $status .= '<i class="bi bi-clipboard" style="color: green;"></i> ';
                }

                if (!$invoiceReminders->invoice_submitted) {
                    $status .= '<i class="bi bi-receipt" style="color: red;"></i> ';
                } else {
                    $status .= '<i class="bi bi-receipt" style="color: green;"></i> ';
                }

                if ($invoiceReminders->finance_status !== 'Clearing' && $invoiceReminders->finance_status !== 'Done') {
                    $status .= '<i class="bi bi-bank" style="color: red;"></i> ';
                } else {
                    $status .= '<i class="bi bi-bank" style="color: green;"></i> ';
                }

                return $status;
            })
            ->addColumn('action', function ($invoiceReminders) {
                return '<a onclick="editForm(' . $invoiceReminders->ir_id . ')" class="btn btn-primary btn-xs"><i class="bi bi-pencil"></i></a> ' .
                    '<a onclick="deleteData(' . $invoiceReminders->ir_id . ')" class="btn btn-danger btn-xs"><i class="bi bi-trash"></i></a>';
            })
            ->rawColumns(['status', 'action'])->make(true);
    }
}
