<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    //
    public function sendEmail(Request $request)
    {
        // Retrieve data from the request
        $prNumber = $request->input('pr_number');

        // Replace with your email sending logic
        $emailData = [
            'pr_number' => $prNumber,
            // Add more data as needed
        ];

        // Send the email using a mailable class
        Mail::to('c0669439@@vale.com')->send(new YourEmailMailable($emailData));

        // Redirect or return a response
        return redirect()->back()->with('success', 'Email sent successfully');
    }
}
