<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\MessageController;

use App\Models\Log as tbl_log;

// TRAITS
use App\Traits\ConnectableDbTrait;

class ExportMessage extends Command
{
    use ConnectableDbTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:export-message {userId} {codtipodoc} {prefmov} {nummov}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send messages to WhatsApp and telegram';

    protected $connection;
    protected $context = [];
    /**
     * Execute the console command.
     */
    public function handle()
    {
        try{
            $userId  = $this->argument('userId', null);
            $codTipodoc = $this->argument('codtipodoc', null);
            $prefMov = $this->argument('prefmov', null);
            $numMov = $this->argument('nummov', null);

            $this->context = [
                'user_id' => $userId,
                'Tipodoc' => $codTipodoc
            ];

            $ConnController = new ConnectionController();

            $connection = $ConnController->index($userId,$codTipodoc,$prefMov,$numMov);

            if($connection == null){
                tbl_log::insertLog($userId,
                $codTipodoc,
                'app:export-message[handle()] => Conexion externa: Linea ' . __LINE__ . '; ' );
                return 1;
            }else{
                    $messageController = new MessageController();

                    $messageController->index($userId,$this->context);
            }
        }catch (\Exception $e) {
            echo 'Error in the connection';
            $context['code'] = $e->getCode();
            $context['trace'] = $e->getTraceAsString();
            $context['from'] = 'app:export-message handle()';
            Log::error($e->getMessage(), $this->context);
            return 1;
        }
    }
}
