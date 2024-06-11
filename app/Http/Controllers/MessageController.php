<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

use App\Models\Message;
use App\Models\ExternalMessage;

use App\Traits\ConnectApiTrait;

class MessageController extends Controller
{
    use ConnectApiTrait;
    /**
     * Display a listing of the resource.
     */
    public function send($user,$codtipodoc,$prefmov,$nummov)
    {
        try{
             // $query = ExternalMessage::wiht('message')->find();
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
            $pdf='';
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
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function pdf($content = null)
    {
        if ($content === null) {
            $content = '<h1>Hola PDF</h1>'; // Contenido por defecto si no se proporciona ninguno
        }

        $pdf = Pdf::loadHTML($content);
        return $pdf->stream('archivo.pdf');
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
