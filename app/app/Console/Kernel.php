<?php

namespace App\Console;

use App\Console\Commands\ExtractAudioText;
use App\Console\Commands\MapFields;
use App\Console\Commands\SyncRadioCanada;
use App\Console\Commands\UpdateJobStatuses;
use App\Console\Commands\UpdateVerbatim;
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
        SyncRadioCanada::class,
        MapFields::class,
        UpdateVerbatim::class,
        UpdateJobStatuses::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
