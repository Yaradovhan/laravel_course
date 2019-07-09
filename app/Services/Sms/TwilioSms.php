<?php

namespace App\Services\Sms;

use Illuminate\Support\Facades\Log;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client as Client;

class TwilioSms implements SmsSender
{
    private $client;

    public function __construct($id, $token)
    {
        try {
            $this->client = new Client($id, $token);
        } catch (ConfigurationException $e) {
            throw new ConfigurationException($e->getMessage());
        }
    }

    public function send($number, $text): void
    {
        Log::info($text, [$number, $text]);
        $this->client->messages->create(
            $number,
            array(
                'from' => '+17542223410',
                //TODO номер телефона, с которого отправляется смс, брать с кабинета(если не триал), или записать в конфиг и брать оттуда
                'body' => $text
            )
        );
    }
}
