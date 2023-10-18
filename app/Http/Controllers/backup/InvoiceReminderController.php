<?php

namespace App\Http\Controllers;

use App\Models\InvoiceReminder;
use App\models\Vendor;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceReminderMail;
use App\Models\Invoice;
use Carbon\Carbon;


class InvoiceReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $ir_id= $request->input('ir_id');
        $pr_number= $request->input('pr_number');
        $invoiceReminders = InvoiceReminder::all();
        $lastestPRNumber = InvoiceReminder::all()->sortByDesc('pr_number');
        $lastRecordPRNumber = InvoiceReminder::max('pr_number')+1;
        $lastRecordPRNumberr = InvoiceReminder::max('pr_number');
        // $ifPIsubmitted= InvoiceReminder::where('ir_id',$ir_id)->first();
        $ir= InvoiceReminder::where('pr_number', $lastRecordPRNumber)->first();
        $invoiceRemindersPR = InvoiceReminder::where('pr_number', $lastRecordPRNumberr)->get();
        $piApproved = $invoiceRemindersPR->pluck('pr_approved')->first();
        // $lastRecordPRNumberNew = $lastRecordPRNumber->pr_number + 1;
        return view('layouts.invoiceReminder.showAll', compact('invoiceReminders', 'lastRecordPRNumber','lastestPRNumber','piApproved','invoiceRemindersPR'));

    }


    public function sendEmail(Request $request, int $pr_number)
    {
        $invoiceReminder = InvoiceReminder::findOrFail($pr_number);
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
        'pr_number' => 'nullable',
        'supplier_name' => 'nullable',
        'pr_type' => 'nullable',
        'pr_approved' => 'nullable|boolean',
        'po_number' => 'nullable',
        'invoice_date' => 'nullable|date',
        'invoice_received_date' => 'nullable|date',
        'bast_status' => 'nullable|boolean',
        'invoice_submission_deadline' => 'nullable|date',
        'invoice_submitted_date' => 'nullable|date',
        'finance_reminder' => 'nullable|integer',
        'finance_status' => 'required|in:Done,MIRO,Clearing,Unknown',
        'tag_input' => 'nullable',
    ]);

    // Convert checkbox values to boolean
    $data['pr_approved'] = $request->has('pr_approved');
    $data['bast_status'] = $request->has('bast_status');
    dd($request->all());
    // InvoiceReminder::updateOrCreate( ['pr_number' => $data['pr_number']],$data);
// dd($request);
    // return redirect('invoiceReminder')->with('success', 'Invoice created');
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
    public function edit(InvoiceReminder $invoiceReminder)
    {
        // $invoiceReminder = InvoiceReminder::findOrFail($pr_number);
        // return view('layouts.edit', compact('invoiceReminder'));

        // $where = array('id' => $request->id);
        // $employee  = InvoiceReminder::where($where)->first();

        // return Response()->json($employee);
        // return view('layouts.invoiceReminder.edit_invoice',compact('pr_number'));
        return view('layouts.invoiceReminder.edit_invoice', compact('invoiceReminder'));


    }
    public function passData(Request $request)
{

    $tags = $request->input('tags');


    dd($tags);
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $pr_number)
    {



        $invoiceReminder
         = InvoiceReminder::findOrFail($pr_number);
        $request->validate([
            'supplier_name' => 'required',
            // Add validation rules for other fields
        ]);

        $invoiceReminder->update($request->all());

        return redirect('invoiceReminder')
            ->with('success', 'Invoice reminder updated successfully.');

        // $post = InvoiceReminder::find($pr_number);

        // $post->supplier_name =  $request->input('supplier_name');
        // $post->pr_type =  $request->input('pr_type');
        // $post->pr_approved =  $request->input('pr_approved');
        // $post->po_number =  $request->input('po_number');
        // $post->invoice_date =  $request->input('invoice_date');
        // $post->invoice_received_date =  $request->input('invoice_received_date');
        // $post->bast_status =  $request->input('bast_status');
        // $post->invoice_submission_deadline =  $request->input('invoice_submission_deadline');
        // $post->invoice_submitted_date =  $request->input('invoice_submitted_date');
        // $post->finance_reminder =  $request->input('finance_reminder');
        // $post->finance_status =  $request->input('finance_status');


        // $post->save();
        // return redirect('/')->with('success', 'Invoice updated successfully');

        // return redirect()->route('post.index')->with('message', "post updated successfully");
    //     $invoiceReminder = InvoiceReminder::findOrFail();


    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'supplier_name' => 'required',
    //         'pr_type' => 'nullable|string',
    //         'pr_approved' => 'boolean',
    //         'po_number' => 'nullable|numeric',
    //         'invoice_date' => 'nullable|date',
    //         'invoice_received_date' => 'nullable|date',
    //         'bast_status' => 'boolean',
    //         'invoice_submission_deadline' => 'nullable|date',
    //         'invoice_submitted_date' => 'nullable|date',
    //         'finance_reminder' => 'nullable|numeric',
    //         'finance_status' => 'nullable|string',
    //     ]);

    //     // Update the invoice reminder with the validated data
    //     $invoiceReminder->update($validatedData);

    //     // Redirect or return a response as needed
    //     return redirect()->route('your.route')->with('success', 'Invoice reminder updated successfully.');
    //
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $pr_number)
    {
        //
        InvoiceReminder::find($pr_number)->delete();
        // return redirect()->back()->with('success', 'Data delete successfully');
        return response()->json(['success'=>'Product deleted successfully.']);
        // return redirect('/')->with('success', 'Invoice created ');

    }
}
