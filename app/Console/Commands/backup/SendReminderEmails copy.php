<?php

namespace App\Console\Commands;

use App\Models\Vendor;
use App\Models\pic;
use App\Models\invoice_reminder;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\invoice_reminder_model;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reminder1Mail;
use App\Mail\Reminder2Mail;
use App\Mail\Reminder3Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Log;

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
        $invoices = invoice_reminder::where(function ($query) {
            $query->whereNull('finance_status')
                ->orWhereNotIn('finance_status', ['Done', 'Clearing']);
        })->get();
        foreach ($invoices as $invoice) {
            $matchingVendor = vendor::where('id', $invoice->vendor)->first();
            $matchingCompany = vendor::where('name', $matchingVendor->vendor)->get();
            $created_at = Carbon::parse($invoice->created_at);
            $pi_submitted_at = Carbon::parse($invoice->pi_submitted_at);
            // $pi_submitted_at = Carbon::parse($invoice->pi_submitted_at);
            $selectAM = pic::where('vendor_id', $invoice->vendor)
                ->get()
                ->pluck('email');
            $invoice_submitted_at = Carbon::parse($invoice->invoice_submitted_at);
            // foreach ($matchingCompany as $vendor) {
            $emailTo = $invoice->selectAM;
            $emailCc = $invoice->email_cc;
            //     $invoice_submitted_at = Carbon::parse($invoice->invoice_submitted_at);

            //     $parsedCreated_at = Carbon::parse($invoice->created_at);
            if (!$invoice->pi_submitted && $created_at->diffInDays(now()) >= 3) {


                // Split the email addresses into an array
                $emailToArray = explode(',', $emailTo);
                $emailCcArray = explode(',', $emailCc);
                $emailData = [
                    'invoice_number' => $invoice->invoice_number,
                    'pr_number' => $invoice->pr_number,
                    'vendor' => $invoice->vendor,


                    // Add more data as needed
                ];
                // Send the first reminder email to the vendor
                Mail::to($selectAM)
                    ->cc($emailCcArray)
                    ->send(new Reminder1Mail($emailData));

                // Log the email
                Log::info('Reminder1Mail sent to: ' . implode(', ', $emailToArray));
                $invoice->created_at = now();
                // Update the timestamp for the first reminder
                $invoice->save();
            }

            if ($invoice->pi_submitted && !$invoice->invoice_submitted && $pi_submitted_at->diffInDays(now()) >= 3) {
                // Send the second reminder email to the vendor
                // Mail::to($vendor->email)->send(new Reminder2Mail());

                $emailTo = $invoice->email_to;
                $emailCc = $invoice->email_cc;

                // Split the email addresses into an array
                $emailToArray = explode(',', $emailTo);
                $emailCcArray = explode(',', $emailCc);
                $emailData = [
                    'pr_number' => $invoice->pr_number,
                    'vendor' => $invoice->vendor,


                    // Add more data as needed
                ];
                Mail::to($selectAM)
                    ->cc($emailCcArray)
                    ->send(new Reminder2Mail($emailData));
                // Log the email
                Log::info('Reminder2Mail sent to: ' . implode(', ', $emailToArray));
                $invoice->pi_submitted_at = now();
                // Update the timestamp for the second reminder
                $invoice->save();
            }

            if ($invoice->pi_submitted && $invoice->invoice_submitted && $invoice_submitted_at->diffInDays(now()) >= 3) {
                // Send the third reminder email to the vendor
                // Mail::to($vendor->email)->send(new Reminder3Mail());
                $emailTo = $invoice->email_to;
                $emailCc = $invoice->email_cc;

                // Split the email addresses into an array
                $emailToArray = explode(',', $emailTo);
                $emailCcArray = explode(',', $emailCc);
                $emailData = [
                    'pr_number' => $invoice->pr_number,
                    'vendor' => $invoice->vendor,


                    // Add more data as needed
                ];
                Mail::to($selectAM)
                    ->cc($emailCcArray)
                    ->send(new Reminder3Mail($emailData));
                // Log the email
                Log::info('Reminder3Mail sent to: ' . implode(', ', $emailToArray));
                $invoice->invoice_submitted_at = now();
                // Update the timestamp for the third reminder
                $invoice->save();
            }
            // }
            // $invoice->save();
        }
    }
}
