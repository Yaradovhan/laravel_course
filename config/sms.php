<?php

return [
//  'sid' => env("TWILIO_SID"),
//  'token' => env("TWILIO_TOKEN")

    'driver' => env('SMS_DRIVER', 'twilio'),
    'drivers' => [
        'twilio' => [
            'sid' => env("TWILIO_SID"),
            'token' => env("TWILIO_TOKEN")
        ],
    ],
];
