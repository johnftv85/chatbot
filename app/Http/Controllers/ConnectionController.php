<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ExternalConnection;
use App\Models\User;
use App\Models\Log;
// TRAITS
use App\Traits\ConnectableDbTrait;

class ConnectionController extends Controller
{
    use ConnectableDbTrait;
    /**
     * Display a listing of the resource.
     */
    public function index($userId,$codtipodoc,$prefmov,$nummov)
    {   
        $user = User::with('external_connection')->find($userId);
            //  return response()->json($user->external_connection->state);
            
        if($user->external_connection->state == 0){      
            return response()->json('El Usuario '.$user->name.' con el id '.$user->id.' esta inactivo.'); 
            exit;
        }else{
            $this->database($user);
            $message = new MessageController();
            $message->send($user->id,$codtipodoc,$prefmov,$nummov);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
