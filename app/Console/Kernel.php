<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define los comandos de Artisan personalizados.
     */
    protected $commands = [
        \App\Console\Commands\ProcessScheduledTasks::class,
    ];

    /**
     * Define las tareas programadas.
     */
    protected function schedule(Schedule $schedule): void
    {
        //  $schedule->command('inspire')->hourly();
        $schedule->command('tasks:process')->everyMinute();
    }

    /**
     * Registra los comandos en la consola.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
