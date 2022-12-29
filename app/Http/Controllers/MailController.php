<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendEmail() {
        $details = [
            'name' => "K M Sunami",
            'type' => "Bio Data"
        ];

        Mail::to("charithdula@gmail.com")->send(new Mailer($details));
        return "Email Sent";
    }
}
