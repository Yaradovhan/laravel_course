<?php

namespace App\Providers;

use App\Services\Sms\ArraySender;
use App\Services\Sms\SmsSender;
use App\Services\Sms\TwilioSms;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SmsSender::class, function ($app) {
            $config = $app->make('config')->get('sms');

            switch ($config['driver']) {
                case 'twilio':
                    $params = $config['drivers']['twilio'];
                    return new TwilioSms($params['sid'], $params['token']);
                    break;
                case 'array':
                    return new ArraySender();
                    break;
                default :
                    throw new \InvalidArgumentException('Undefined SMS driver ' . $config['driver']);

            }
        });
    }

    public function boot(): void
    {
        //
    }
}
