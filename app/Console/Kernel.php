<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('app:send-daily-report')->dailyAt('08:00');
        $schedule->command('app:send-weekly-email')->weeklyOn(1,'09:00');
        $schedule->command('app:send-bulk-emails')->weeklyOn(1,'10:00');
        $schedule->command('app:process-file-uploads')->dailyAt('02:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
