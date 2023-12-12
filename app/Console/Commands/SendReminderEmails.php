<?php

namespace App\Console\Commands;

use App\Models\Vendor;
use App\Models\invoice_reminder;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\invoice_reminder_model;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reminder1Mail;
use App\Mail\Reminder2Mail;
use App\Mail\Reminder3Mail;
use Illuminate\Mail\Mailable;

class SendReminderEmails extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder emails every 3 days';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();

    }
    public function handle()
    {
        //      Mail::to('merqinko.a@gmail.com')->send(new Reminder1Mail());
        // $invoices = invoice_reminder::whereNotIn('finance_status', ['Done', 'clearing'])->get();
        $invoices = invoice_reminder::where(function($query) {
            $query->whereNull('finance_status')
                  ->orWhereNotIn('finance_status', ['Done', 'Clearing']);
        })->get();
        foreach ($invoices as $invoice) {
            $matchingVendor= vendor::where('id', $invoice->supplier_name)->get();

            foreach ($matchingVendor as $vendor){
            $updated_at_1=Carbon::parse($invoice->updated_at_1);
            $updated_at_2=Carbon::parse($invoice->updated_at_2);
            $updated_at_3=Carbon::parse($invoice->updated_at_3);
            $parsedCreated_at = Carbon::parse($invoice->created_at);
            if (!$invoice->pi_submitted && $parsedCreated_at->diffInDays(now()) >= 3 ) {
                // Send the first reminder email to the vendor
                Mail::to($vendor->email)->send(new Reminder1Mail());

                // Update the timestamp for the first reminder
                // $invoice->created_at_1 = now();
                $invoice->updated_at_1 = now();
                $invoice->save();
            }

            if ($invoice->pi_submitted && !$invoice->invoice_submitted && $updated_at_2->diffInDays(now()) >= 3) {
                // Send the second reminder email to the vendor
                Mail::to($vendor->email)->send(new Reminder2Mail());

                // Update the timestamp for the second reminder
                // $invoice->created_at_2 = now();
                $invoice->updated_at_2 = now();
                $invoice->save();
            }

            if ($invoice->pi_submitted && $invoice->invoice_submitted && $updated_at_3->diffInDays(now()) >= 3) {
                // Send the third reminder email to the vendor
                Mail::to($vendor->email)->send(new Reminder3Mail());

                // Update the timestamp for the third reminder
                // $invoice->created_at_3 = now();
                $invoice->updated_at_3 = now();
                $invoice->save();
            }
        }
            // $invoice->save();
        }
    }
}
