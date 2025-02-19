<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\ScheduledTask;
use App\Models\TransactionalOrder;
use App\Jobs\SendMessageJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ProcessScheduledTasks extends Command
{
    protected $signature = 'tasks:process';
    protected $description = 'Procesa tareas programadas';

    public function handle()
    {
        $tasks = TransactionalOrder::where('status', '9')
            ->whereNotNull('schedule')
            ->where('schedule', '<=', Carbon::now())
            ->get();

        foreach ($tasks as $task) {
            try {
                dispatch(new SendMessageJob(
                    $task->cellphone,
                    $task->message,
                    $task->attachment,
                    $task->id
                ));

            } catch (\Exception $e) {
                Log::error('Error al procesar tarea: ' . $e->getMessage());
            }
        }
    }
}
