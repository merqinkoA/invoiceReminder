<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\invoice_reminder;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Jobs\SendFirstInvoiceReminderEmail;
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
        $vendors = Vendor::all();
        $invoice_reminders = Invoice_Reminder::all();
        return view('layouts.invoiceReminder.index', compact('invoice_reminders','timezone','vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = Vendor::all();
        //   return view('invoice_reminders.create');
        return view('layouts.invoiceReminder.create', compact('vendors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


    $validatedData = $request->validate([
        'invoice_number' => 'nullable|numeric',
        'supplier_name' => 'nullable|string',
        'currency' => 'nullable|string',
        'net_value' => 'nullable|string',
        'pr_number' => 'nullable|string',

    ]);

    $invoiceReminder = new Invoice_Reminder;
    $invoiceReminder->invoice_number = $validatedData['invoice_number'];
    $invoiceReminder->supplier_name = $validatedData['supplier_name'];
    $invoiceReminder->currency = $validatedData['currency'];
    $invoiceReminder->net_value = $validatedData['net_value'];
    $invoiceReminder->pr_number = $validatedData['pr_number']?? null;
    $invoiceReminder->pi_submitted = $request->has('pi_submitted');
    $invoiceReminder->save();
   // Calculate submission date and reminder date
    $submissionDate = now();
    $reminderDate = $submissionDate->addDays(3);
    // $selectedVendor = Vendor::find($request->supplier_name);

        if (!$request->has('pi_submitted') || !$request->input('pi_submitted')) {
            // Find all vendors with the same supplier_name
            $invoiceReminder->pi_submitted_date = $submissionDate;
            $invoiceReminder->save();

            // $vendors = Vendor::where('id', $request->supplier_name)->first();
            // if ($vendors) {
            //     // Find other vendors with the same supplier_name
            //     $relatedVendors = Vendor::where('company_name', $vendors->company_name)->get();

            //     // Collect the email addresses from the related vendors
            //     $relatedEmails = $relatedVendors->pluck('email');

            //     // Join the email addresses into a single string with commas
            //     $vendorEmails = $relatedEmails->implode(', ');

            //     // Now, $emailsString contains all email addresses from vendors with the same supplier_name
            // }
            // SendFirstInvoiceReminderEmail::dispatch($vendorEmails, $reminderDate);

        }
        // dd($emailsString);
    // return redirect()->route('layouts.invoiceReminder.index')->with('success', 'Invoice Reminder created successfully.');

    return redirect()->route('invoiceReminder.index')
    ->withSuccess('Invoice has been created successfully.');//

    }
    public function sendEmail(Request $request, int $pr_number)
    {
        $invoiceReminder = invoice_reminder::findOrFail($pr_number);
        $Vendors = Vendor::all();
        $emailRecipients=
        $recipients = [
            'c0669439@vale.com',
            'c0636967@vale.com',
            'c0652652@vale.com',
            // Add more recipients as needed
        ];
        // Customize this part to gather the necessary data for your email
        $emailData = [
            'pr_number' => $invoiceReminder->pr_number,
            'supplier_name' => $invoiceReminder->supplier_name,


            // Add more data as needed
        ];

        // Send the email using the Mailable class
        Mail::to('merqinko.a@gmail.com,merqinko@gmail.com')->send(new InvoiceReminderMail($emailData));

        return redirect()->back()->with('success', 'Email sent successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(invoice_reminder $invoice_reminder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {$vendors = Vendor::all();

            // Load the specific invoice_reminder record by its ID
            $invoice_reminder = invoice_reminder::find($id);

            if (!$invoice_reminder) {
                // Handle the case where the record does not exist
                return redirect()->route('invoiceReminder.index')->with('error', 'Invoice Reminder not found');
            }

            return view('layouts.invoiceReminder.edit', compact('invoice_reminder','vendors'));
        }
    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, int $invoice_reminder)
{
    $validatedData = $request->validate([
        'invoice_number' => 'required|numeric',
        'supplier_name' => 'nullable|string',
        'currency' => 'required|string',
        'net_value' => 'nullable|string',
        'pr_number' => 'nullable|string',
        'due_date' => 'nullable|date',
        'ses_migo_date' => 'nullable|date',
        'po_number' => 'nullable|string',
        'ses_migo_number' => 'nullable|string',
        'finance_status' => 'nullable|in:Done,MIRO,Clearing,Unknown',
    ]);

    $invoice_reminder = invoice_reminder::findOrFail($invoice_reminder);
    $invoice_reminder->invoice_number = $validatedData['invoice_number'];
    $invoice_reminder->supplier_name = $validatedData['supplier_name'];
    $invoice_reminder->currency = $validatedData['currency'];
    $invoice_reminder->net_value = $validatedData['net_value'];
    $invoice_reminder->pi_submitted = $request->has('pi_submitted');
    $invoice_reminder->pr_number = $validatedData['pr_number'];

    if (isset($validatedData['due_date'])) {
        $invoice_reminder->due_date = $validatedData['due_date'];
    }

    $invoice_reminder->ses_migo_date = $validatedData['ses_migo_date'];
    $invoice_reminder->invoice_submitted = $request->has('invoice_submitted');
    $invoice_reminder->po_number = $validatedData['po_number'];
    $invoice_reminder->ses_migo_number = $validatedData['ses_migo_number'];

    if (isset($validatedData['finance_status'])) {
        $invoice_reminder->finance_status = $validatedData['finance_status'];
    }

    $invoice_reminder->save();

    // Check if pi_submitted is true or checked
    if ($request->has('pi_submitted')) {
        $invoice_reminder->pi_submitted_date = now();
        $invoice_reminder->save();
    }
    // Check if invoice_submitted is true or checked
    if ($request->has('invoice_submitted')) {
        $invoice_reminder->invoice_submitted_date = now();
        $invoice_reminder->save();
    }

    return redirect()->route('invoiceReminder.index')->with('success', 'Invoice Reminder updated successfully.');
}


    public function destroy(Request $request, int $invoice_Reminder)
    {
        $test=invoice_reminder::where('ir_id', $invoice_Reminder)->delete();
        // $invoice_reminder->where('ir_id', $invoice_reminder->ir_id)->update(['delete_status' => 1]);
// dd($invoice_Reminder);
        return redirect()->route('invoiceReminder.index')->with('success', 'Invoice Reminder deleted successfully.');
    }

}
