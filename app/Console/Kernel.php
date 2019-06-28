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
        \App\Console\Commands\MerchantRemoteDateFetchingCommand::class,
        \App\Console\Commands\getswiftDeliveriesUpload::class,
        \App\Console\Commands\CustomersToMailchimp::class,
        \App\Console\Commands\TransactionsToMailchimp::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
         $schedule->command('merchant-remote-data-fetch')
                  ->everyMinute()->withoutOverlapping();

        $schedule->command('sync:getswift-deliveries')
            ->everyMinute()->withoutOverlapping();

        $schedule->command('mailchimp:customers')
            ->daily()->withoutOverlapping();

        $schedule->command('mailchimp:transactions')
            ->everyTenMinutes()->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
