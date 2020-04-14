<?php

namespace ProjectApp\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use ProjectApp\Console\Commands\BackupDatabaseCommand;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        BackupDatabaseCommand::class
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('queue:work --tries=3')
        // ->cron('* * * * * ')
        // ->withoutOverlapping();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
