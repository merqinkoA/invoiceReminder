<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\Reminder1Mail;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception; // Import the Exception class

class SendFirstInvoiceReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $invoiceReminder;
    protected $vendorEmails;
    protected $reminderDate;
    /**
     * Create a new job instance.
     */
    public function __construct($vendorEmails, $reminderDate, $invoiceReminder)
    {
        $this->vendorEmails = $vendorEmails;
        $this->reminderDate = $reminderDate;
        $this->invoiceReminder = $invoiceReminder;
    }

    /**
     * Execute the job.
     */


    public function handle(): void
    {
        $vendorEmails = $this->vendorEmails;

        try {

            // Attempt to send the email
            Mail::to($vendorEmails)->send(new Reminder1Mail());

            // Save the pi_submitted_date with the current date
            // $this->invoiceReminder->pi_submitted_date = now();
            // $this->invoiceReminder->save();
        } catch (Exception $e) {
            // If an error occurs while sending the email, catch the exception
            // and log the error or send a notification (e.g., through Slack, email, etc.)

            // Example 1: Logging the error
            Log::error('Email sending failed: ' . $e->getMessage());

            // Example 2: Sending a notification (e.g., via Laravel's built-in notification channels)
            // \Notification::route('slack', config('services.slack.webhook'))->notify(new EmailSendingFailed($e));

            // You can customize this error handling based on your preferences and needs.
        }

    }
}
