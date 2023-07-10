<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendSms extends Controller
{
    public function send()
    {
        $basic = new \Vonage\Client\Credentials\Basic("ae6775d8", "FGzDdqMzOtyE6Uvt");
        $client = new \Vonage\Client($basic);

        $response = $client->sms()->send(
            new \Vonage\SMS\Message\SMS("972599984799", 'Store', 'test message')
        );

        return response()->json('sms has been sent successfully', 200);
    }
}