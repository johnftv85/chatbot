<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Cron\CronExpression;

use App\Models\Command;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        try{
            $parameters = Command::all();

            foreach($parameters as $parameter){

                if(empty($parameter)){
                    Log::warning('No hay commando configurado para integracion', [
                        'sheduling' => 1
                    ]);
                }
                $cron = CronExpression::factory($parameter);
                if(str_contains($parameter['command'],'app:export-message')){

                    $schedule->command($parameter['command'])->everyMinute();
                }
            }

        }catch (\Exception $e){
            Log::error($e->getMessage(), [
                'line' => $e->getLine(),
                'code' => $e->getCode(),
                'from' => 'Kernel'
            ]);
        }
        // $schedule->command('inspire')->hourly();
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
