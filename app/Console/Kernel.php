<?php

namespace App\Console;


use App\Models\invoice_reminder;
use Carbon\Carbon;
use App\Mail\InvoiceReminderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands=[
        Commands\DemoCron::class,
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('send:reminders') ->everyMinute();
        // $schedule->command('inspire')->hourly();
        // $schedule->call(function () {
        //     $invoiceReminders = Invoice_Reminder::where('pi_submitted', false)->get();

        //     foreach ($invoiceReminders as $reminder) {
        //         // Check if it's time to send the reminder (every 3 days)
        //         if ($reminder->created_at->diffInDays(now()) % 3 === 0) {
        //             // Send the reminder email
        //             Mail::to($reminder->email)->send(new InvoiceReminderMail($reminder));
        //         }
        //     }

        //     // Check the Invoice_Reminder model for entries with 'pi_submitted' set to false
        //     // and send email reminders if necessary.
        // })->everyThreeDays();


        // $schedule->call(function () {
        //     $invoiceReminders = invoice_reminder::where('pi_submitted', false)
        //         ->orWhere('finance_status', '!=', 'done')
        //         ->get();

        //     foreach ($invoiceReminders as $reminder) {
        //         $createdTimestamp = $reminder->created_at->timestamp;
        //         $currentTimestamp = now()->timestamp;
        //         $emailTemplate = null;

        //         // Check if it's time to send reminders and choose the email template
        //         if ($reminder->pi_submitted === false) {
        //             if (($currentTimestamp - $createdTimestamp) % (3 * 24 * 60 * 60) === 0) {
        //                 $emailTemplate = new Reminder1Mail();
        //             }
        //         } elseif ($reminder->invoice_submitted === false) {
        //             if (($currentTimestamp - $createdTimestamp) % (3 * 24 * 60 * 60) === 0) {
        //                 $emailTemplate = new Reminder2Mail();
        //             }
        //         } elseif ($reminder->finance_status !== 'done') {
        //             if (($currentTimestamp - $createdTimestamp) % (3 * 24 * 60 * 60) === 0) {
        //                 $emailTemplate = new Reminder3Mail();
        //             }
        //         } else {
        //           test

        //          }

        //         if ($emailTemplate !== null) {
        //             // Send the reminder email
        //             Mail::to($reminder->vendor_email)->send($emailTemplate);
        //         }

        // })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

}
