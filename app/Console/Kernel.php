<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\CampaignUnhandled',
        'App\Console\Commands\ChangeDesignerImagePaths',
        'App\Console\Commands\ChangePageImagePaths',
        'App\Console\Commands\ChangeProductImagePaths',
        'App\Console\Commands\fixBrokenImageFilenames',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        /**
        * Run queue worker every five minutes
        * http://laravelcoding.com/blog/laravel-5-beauty-sending-mail-and-using-queues
        */
        $schedule->command('queue:work --once')->everyMinute();

        /**
        * Run campaign unhandled hourly between 07 and 24
        */
        $schedule ->command('campaign:unhandled')
            ->hourly()
            ->when(function () {
                return date('H') >= 7 && date('H') <= 24;
            });
    }

    /**
     * TODO Register the Closure based commands for the application.
     *
     * @return void
     */
    // protected function commands()
    // {
    //     require base_path('routes/console.php');
    // }
}
