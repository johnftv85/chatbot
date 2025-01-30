<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransactionalOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TransactionalOrderController extends Controller
{
/**
     * Mostrar el estado de una transacción.
     *
     * @param string $transaction_code
     * @return \Illuminate\Http\JsonResponse
     */
    public function statuswh(Request $request)
    {
        $request->validate([
            'transaction_code' => 'required|string',
        ]);

        $transactionCode = $request->get('transaction_code');

        $transactions = TransactionalOrder::with('messages')
            ->where('transaction_code', $transactionCode)
            ->get();

        if ($transactions->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No transactions found for the provided code.',
            ], 200);
        }

        $data = $transactions->map(function ($transaction) {
            return [
                'id' => $transaction->id,
                'transaction_status' => $transaction->status,
                'messages' => $transaction->messages->map(function ($message) {
                    return [
                        // 'id' => $message->id,
                        'wa_id' => $message->wa_id,
                        'body' => $message->body,
                        'status' => $message->status,
                        'date' => $message->updated_at->format('Y-m-d H:i:s'),
                    ];
                }),
                'date' => $transaction->created_at->format('Y-m-d H:i:s'),
            ];
        });

        return response()->json([
            'status' => 'success',
            'transaction_code' => $transactionCode,
            'transactions' => $data,
        ]);
    }

    public function reportuser(Request $request)
    {

        $user = request()->user();
        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }
        $request->validate([
            'startdate' => 'required|date',
            'enddate' => 'required|date|after_or_equal:startdate'
        ]);

        $startDate = $request->input('startdate');
        $endDate = $request->input('enddate');

        try {
            $transactions = TransactionalOrder::with('messages')
            ->where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

            if ($transactions->isEmpty()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'No transactions found.',
                ], 200);
            }

            $data = $transactions->map(function ($transaction) {
                return [
                    'id' => $transaction->id,
                    'transaction_status' => $transaction->status,
                    'messages' => $transaction->messages->map(function ($message) {
                        return [
                            'wa_id' => $message->wa_id,
                            'body' => $message->body,
                            'status' => $message->status,
                            'date' => $message->updated_at->format('Y-m-d H:i:s'),
                        ];
                    }),
                    'date' => $transaction->created_at->format('Y-m-d H:i:s'),
                ];
            });

            return response()->json([
                'status' => 'success',
                'User' => $user->name,
                'transactions' => $data,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
