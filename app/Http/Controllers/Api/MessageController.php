<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Emoticon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MessageController extends Controller
{
   public function index()
   {
        try {
            $messages = DB::table('messages', 'm')
                ->whereRaw('m.id IN (SELECT MAX(id) FROM messages m2 GROUP BY wa_id)')
                ->orderByDesc('m.id')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $messages,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }

   }

   public function show($waId, Request $request)
   {
    try {
        $messages = DB::table('messages', 'm')
            ->where('wa_id', $waId)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $messages,
        ], 200);
    } catch (Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
        ], 500);
    }
   }

   public function getEmoticons(Request $request)
   {
       $validatedData = $request->validate([
           'description' => 'nullable|string|max:255',
       ]);

       $description = $validatedData['description'] ?? '';

       $emoticons = Emoticon::where('description', 'like', "%$description%")->get()->map(function ($emoticon) {
        return [
            'id' => $emoticon->id,
            'code' => $emoticon->code,
            'description' => $emoticon->description,
            'emoticon' => urldecode($emoticon->code)
            ];
        });

       return response()->json([
           'status' => 'success',
           'emoticons' => $emoticons,
       ]);
   }
}
