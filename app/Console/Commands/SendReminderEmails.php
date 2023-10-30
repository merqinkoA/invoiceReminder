<?php

namespace App\Console\Commands;

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
        $invoices = invoice_reminder::whereNotIn('finance_status', ['Done', 'clearing'])->get();

        foreach ($invoices as $invoice) {
            if (!$invoice->pi_submitted ) {
                // Send the first reminder email to the vendor
                Mail::to('merqinko.a@gmail.com')->send(new Reminder1Mail());

                // Update the timestamp for the first reminder
                $invoice->created_at = now();
                $invoice->updated_at = now();
            }

            if ($invoice->pi_submitted && !$invoice->invoice_submitted) {
                // Send the second reminder email to the vendor
                Mail::to('merqinko.a@gmail.com')->send(new Reminder2Mail());

                // Update the timestamp for the second reminder
                $invoice->created_at = now();
                $invoice->updated_at = now();
            }

            if ($invoice->pi_submitted && $invoice->invoice_submitted) {
                // Send the third reminder email to the vendor
                Mail::to('merqinko.a@gmail.com')->send(new Reminder3Mail());

                // Update the timestamp for the third reminder
                $invoice->created_at = now();
                $invoice->updated_at = now();
            }

            $invoice->save();
        }
    }
}
