<?php

namespace App\Console;

use App\Models\Managers\CronManager;
use Exception;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function(){

            $result = CronManager::commissions();

            Log::info($result->getMessage(), ['data' => $result->getData()]);
        })
        ->name('Manage Commissions')
        ->hourly();

        $schedule->call(function(){
            $result = CronManager::reviews();
            Log::info($result->getMessage(), ['data' => $result->getData()]);
        })
        ->name('Update Reservation and Reviews')
        ->hourlyAt(30);
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
