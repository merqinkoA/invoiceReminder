<?php

namespace App\Http\Controllers;

use App\Models\InvoiceReminder;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceReminderMail;

class InvoiceReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $invoiceReminders = InvoiceReminder::all();
        $lastestPRNumber = InvoiceReminder::all()->sortByDesc('pr_number');
        $lastRecordPRNumber = InvoiceReminder::max('pr_number')+1;
        // $lastRecordPRNumberNew = $lastRecordPRNumber->pr_number + 1;
        return view('layouts.invoiceReminder.showAll', compact('invoiceReminders', 'lastRecordPRNumber','lastestPRNumber'));

    }
    public function sendEmail(Request $request, int $pr_number)
    {
        $invoiceReminder = InvoiceReminder::findOrFail($pr_number);


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
        Mail::to('merqinko.a@gmail.com')->send(new InvoiceReminderMail($emailData));

        return redirect()->back()->with('success', 'Email sent successfully');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('layouts.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'pr_number' => [
                'required',
                Rule::unique('invoice_reminder', 'pr_number')
            ],
            'supplier_name' => 'required|string|max:255',
            'pr_type' => 'nullable|string',
            'pr_approved' => 'boolean',
            'po_number' => 'nullable|numeric',
            'invoice_date' => 'nullable|date',
            'invoice_received_date' => 'nullable|date',
            'bast_status' => 'boolean',
            'invoice_submission_deadline' => 'nullable|date',
            'invoice_submitted_date' => 'nullable|date',
            'finance_reminder' => 'nullable|numeric',
            'finance_status' => 'nullable|string',

        ]);
        // dd($data);
      InvoiceReminder::create($data);

      return redirect('/')->with('success', 'Invoice created ');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('layouts.show', compact('invoiceReminder'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('layouts.edit', compact('invoiceReminder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $pr_number)
    {
        $invoiceReminderByPRNumber = InvoiceReminder::findOrFail();
        $request->validate([
            'supplier_name' => 'required',
            // Add validation rules for other fields
        ]);

        $invoiceReminderByPRNumber->update($request->all());

        return redirect()->route('layouts.index')
            ->with('success', 'Invoice reminder updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $pr_number)
    {
        //
        InvoiceReminder::find($pr_number)->delete();

        return response()->json(['success'=>'Product deleted successfully.']);
        // return redirect('/')->with('success', 'Invoice created ');

    }
}
