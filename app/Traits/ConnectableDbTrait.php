<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

trait ConnectableDbTrait
{   
    protected function database($connection) {
        try {
            if($connection['external_connection']['state'] == 0){
                return false;
            }
            
            Config::set('database.connections.external.host', $connection['external_connection']['host']);
            Config::set('database.connections.external.username', $connection['external_connection']['user_name']);
            Config::set('database.connections.external.password', $connection['external_connection']['password']);
            Config::set('database.connections.external.database', $connection['external_connection']['name_database']);
            DB::purge('external');
            $database = DB::reconnect('external');
            return $database;
        } catch (Exception $e){
            Log::error($e->getMessage());
            return null;
        }
    }
}
