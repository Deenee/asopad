<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use  Monolog;
use Monolog\Handler\SlackWebhookHandler;
use Log;
use Monolog\Logger;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $monolog = Log::getMonolog();
        if (!\App::environment('local')) {
            $slackHandler = new SlackWebhookHandler('https://hooks.slack.com/services/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', '#paddylogs', 'Paddy Logs', false, 'warning', true, true, Logger::API);
        } else {
            $slackHandler = new SlackWebhookHandler('https://hooks.slack.com/services/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', '#paddylogs', 'Paddy Logs', false, 'warning', true, true, Logger::API);        }
        $monolog->pushHandler($slackHandler);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
