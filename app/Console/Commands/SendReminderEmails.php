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
use Illuminate\Support\Facades\DB;

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
        Log::info('SendReminderEmails command started.');
        $currentMonth = now()->format('F');
        $currentYear = now()->format('Y');
        //      Mail::to('merqinko.a@gmail.com')->send(new Reminder1Mail());
        // $invoices = invoice_reminder::whereNotIn('finance_status', ['Done', 'clearing'])->get();

        $invoices = invoice_reminder::where(function ($query) {
            $query->whereNull('deleted_at') // Ensure the record is not soft-deleted
                ->where(function ($query) {
                    $query->whereNull('finance_status')
                        ->orWhereNotIn('finance_status', ['Done', 'Clearing']);
                });
        })->get();

        // $invoices = invoice_reminder::where(function ($query) {
        //     $query->whereNull('finance_status')
        //         ->orWhereNotIn('finance_status', ['Done', 'Clearing']);
        // })->get();
        foreach ($invoices as $invoice) {
            
            
            $hasVendorInPic = pic::where('id', $invoice->vendor_id)
            ->whereNotNull('email') // Ensure email is not null
            ->where('email', '!=', '')
            ->get()
            ->pluck('email');
      
            // $matchingVendor = vendor::where('id', $invoice->vendor)->first();
            // $matchingVendor = DB::table('vendor')->where('id', $invoice->vendor_id)->first();
            // $matchingCompany = vendor::where('name', $matchingVendor->vendor)->get();
            $matchingVendor = $invoice->vendor; // Access the vendor relationship
            $vendorName = $matchingVendor->name; // Assuming 'name' is the vendor name attribute

            $created_at = Carbon::parse($invoice->reminder_pi_date);
            $invoice_reminder_at = Carbon::parse($invoice->invoice_reminder_at);
            $pi_submitted_at = Carbon::parse($invoice->pi_submitted_at);
            $invoice_submitted_at = Carbon::parse($invoice->invoice_submitted_at);
            // $pi_submitted_at = Carbon::parse($invoice->pi_submitted_at);
            $selectAM = pic::where('vendor_id', $invoice->vendor_id)
                ->whereNotNull('email') // Ensure email is not null
                ->where('email', '!=', '')
                ->get()
                ->pluck('email');
               
            // $vendorName = $invoice->vendor->name;
            // $vendorName = $invoice->vendor->name;
            if ($selectAM->isNotEmpty() && $selectAM->contains(fn ($email) => filter_var($email, FILTER_VALIDATE_EMAIL))) {
             
               
                // foreach ($matchingCompany as $vendor) {
                $emailTo = $invoice->selectAM;
                $emailCc = $invoice->email_cc;
                $emailData = [
                    'invoice_number' => $invoice->invoice_number,
                    'pr_number' => $invoice->pr_number,
                    'vendor' =>  $vendorName,
                    'current_month' => $currentMonth,
                    'current_year' => $currentYear,
                    'net_value' => $invoice->net_value,
                    'currency' => $invoice->currency,
                    'po_number' => $invoice->po_number,
                    'ses_migo_number' => $invoice->ses_migo_number,
                    // Add more data as needed
                ];
                //     $invoice_submitted_at = Carbon::parse($invoice->invoice_submitted_at);

                //     $parsedCreated_at = Carbon::parse($invoice->created_at);
                if (!$invoice->pi_submitted && $invoice_reminder_at->diffInDays(now()) >= 2 && !empty($selectAM)) {
                    Log::info('Reminder1Mail sent to: ' .  $selectAM->implode(', '));

                    try {
                        // Split the email addresses into an array
                        // $emailCcArray = explode(',', $emailCc);
                        $emailCcArray = $emailCc ? explode(',', $emailCc) : [];
                        // Send the first reminder email to the vendor
                        Mail::to($selectAM)
                            ->cc($emailCcArray)
                            ->send(new Reminder1Mail($emailData));

                        // Log the email
                        Log::info('Reminder1Mail sent to: ' .  $selectAM->implode(', '));
                        $invoice->invoice_reminder_at = now();
                        // Update the timestamp for the first reminder
                        $invoice->save();
                    } catch (\Exception $e) {
                        // Log the error along with the email data
                        Log::error('Error sending Reminder1Mail for vendor_id: ' . $invoice->vendor_id);
                        Log::error('Error sending Reminder1Mail for ir_id: ' . $invoice->ir_id);
                        Log::info('No valid email addresses found for vendor_id: ' . $invoice->vendor_id);
                        Log::error('Email data: ' . json_encode($emailData));
                        Log::error('Exception: ' . $e->getMessage());
                    }

                }

                // if ($invoice->pi_submitted && !$invoice->invoice_submitted && !empty($selectAM) && $invoice_reminder_at->diffInDays(now()) >= 3 ) {

                //     Log::info('Reminder2Mail sent to: ' .  $selectAM->implode(', ')); // Send the second reminder email to the vendor
                //     // Mail::to($vendor->email)->send(new Reminder2Mail());
                //     try {
                //         // $emailTo = $invoice->email_to;
                //         // $emailCc = $invoice->email_cc;
                //         $emailCcArray = $emailCc ? explode(',', $emailCc) : [];
                //         // Split the email addresses into an array
                //         // $emailToArray = explode(',', $emailTo);
                //         // $emailCcArray = explode(',', $emailCc);

                //         Mail::to($selectAM)
                //             ->cc($emailCcArray)
                //             ->send(new Reminder2Mail($emailData));
                //         // Log the email
                //         Log::info('Reminder2Mail sent to: ' .  $selectAM->implode(', '));
                //         $invoice->invoice_reminder_at = now();
                //         // Update the timestamp for the second reminder
                //         $invoice->save();
                //     } catch (\Exception $e) {
                //         // Log the error along with the email data
                //         Log::error('Error sending Reminder1Mail for vendor_id: ' . $invoice->vendor_id);
                //         Log::info('No valid email addresses found for vendor_id: ' . $invoice->vendor_id);
                //         Log::error('Email data: ' . json_encode($emailData));
                //         Log::error('Exception: ' . $e->getMessage());
                //     }
                // }
                // if ($invoice->pi_submitted && !$invoice->invoice_submitted && $pi_submitted_at->diffInDays(now()) >= 3 && !empty($selectAM)) {
                //     // Send the second reminder email to the vendor
                //     // Mail::to($vendor->email)->send(new Reminder2Mail());

                //     // $emailTo = $invoice->email_to;
                //     // $emailCc = $invoice->email_cc;

                //     // Split the email addresses into an array
                //     // $emailToArray = explode(',', $emailTo);
                //     // $emailCcArray = explode(',', $emailCc);

                //     Mail::to($selectAM)
                //         ->cc($emailCcArray)
                //         ->send(new Reminder2Mail($emailData));
                //     // Log the email
                //     Log::info('Reminder2Mail sent to: ' .  $selectAM->implode(', '));
                //     $invoice->pi_submitted_at = now();
                //     // Update the timestamp for the second reminder
                //     $invoice->save();
                // }

                // if ($invoice->pi_submitted && $invoice->invoice_submitted && $invoice_submitted_at->diffInDays(now()) >= 7 && !empty($selectAM)) {
                //     // Send the third reminder email to the vendor
                //     // Mail::to($vendor->email)->send(new Reminder3Mail());
                //     // $emailTo = $invoice->email_to;
                //     // $emailCc = $invoice->email_cc;

                //     // Split the email addresses into an array
                //     // $emailToArray = explode(',', $emailTo);
                //     // $emailCcArray = explode(',', $emailCc);

                //     Mail::to($selectAM)
                //         ->cc($emailCcArray)
                //         // to('c0669439@vale.com')
                //         // ->cc('c0636967@vale.com', 'c0675349@vale.com', 'c0652652@vale.com')
                //         ->send(new Reminder3Mail($emailData));
                //     // Log the email
                //     Log::info('Reminder3Mail sent to: ' . $selectAM->implode(', '));
                //     $invoice->invoice_submitted_at = now();
                //     // Update the timestamp for the third reminder
                //     $invoice->save();
                // }
                
            } else {
                // Log a message with the vendor_id causing the issue
                Log::error('Error sending Reminder1Mail for vendor_id: ' . $invoice->vendor_id);
                Log::error('Error sending Reminder1Mail for ir_id: ' . $invoice->ir_id);
                Log::info('No valid email addresses found for vendor_id: ' . $invoice->vendor_id);
                Log::error('Email data: ' . json_encode($emailData));

            }
     
            // }
            // $invoice->save();
        }
        Log::info('SendReminderEmails command completed successfully.');
  
    }
}
