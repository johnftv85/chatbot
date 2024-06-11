<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\ExternalConnection;
use App\Models\Message;
use App\Models\User;
use App\Models\Log;
// TRAITS
use App\Traits\ConnectableDbTrait;
use App\Traits\ConnectApiTrait;

class ConnectionController extends Controller
{
    use ConnectableDbTrait, ConnectApiTrait;
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
            try{
                $this->database($user);

               $query = Message::where('area_id', $codtipodoc)->first();
   
               $replace =[
                   '@prefmov' => $prefmov,
                   '@nummov' => $nummov,
               ];
               
               if (!$query) {
                   return response()->json(['error' => 'Message codtipodoc not found'], 404);
               }else{
                   $query->query = str_replace(array_keys($replace), array_values($replace), $query->query);
               }
               
               $responds = DB::connection('external')->select($query->query);
               
               $pdf = Pdf::loadView('pdf',['responds' => $responds]);
               return $pdf->stream();
            //    return $pdf->download('pedido.pdf');
                exit;
               $response = $this->api($responds, $user, $query,$pdf); 
   
               if ($response) {
                   Log::info('Message sent successfully', ['response' => $response]);
                   return response()->json($response, 200);
               } else {
                   Log::error('Failed to send message');
                   return response()->json(['error' => 'Failed to send message'], 500);
               }
           }catch (\Exception $e) {
               Log::error('Exception occurred while sending message', [
                   'error' => $e->getMessage(),
                   'trace' => $e->getTraceAsString(),
               ]);
               return response()->json(['error' => 'An error occurred'], 500);
           }
            // return view('pdf');
            // exit;
            // $this->database($user);
            // $message = new MessageController();
            // $message->send($user->id,$codtipodoc,$prefmov,$nummov);
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
