<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TransactionalOrder;
use Carbon\Carbon;
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
                'schedule' => $transaction->schedule,
                'chatgpt' => $transaction->chatgpt,
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
            'startdate' => 'required|date_format:Y-m-d',
            'enddate' => 'required|date_format:Y-m-d|after_or_equal:startdate',
            'status' => 'nullable|integer',
            'account' => 'nullable|string',
        ]);

        $startDate = Carbon::parse($request->input('startdate'))->startOfDay();
        $endDate = Carbon::parse($request->input('enddate'))->endOfDay();
        $status = $request->input('status');
        $account = $request->input('account');

        try {
            $transactions = TransactionalOrder::with(['messages', 'user'])
            ->when($user->email === 'super@bexsoluciones.com', function ($query) use ($account) {
                // Si "super" recibe un filtro de "account", solo muestra ese usuario.
                if (!empty($account)) {
                    return $query->whereHas('user', function ($q) use ($account) {
                        $q->where('email', $account);
                    });
                }
                // Si no hay filtro "account", ve todo.
            })
            ->when($user->email !== 'super@bexsoluciones.com', function ($query) use ($user) {
                // Si NO es "super", solo ve sus propias transacciones, sin importar "account".
                return $query->where('user_id', $user->id);
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->when(!empty($status), function ($query) use ($status) {
                return $query->where('status', $status);
            })
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
                    'schedule' => $transaction->schedule,
                    'chatgpt' => $transaction->chatgpt,
                    'created_by' => $transaction->user ? $transaction->user->email : 'Unknown',
                    'date' => $transaction->created_at->format('Y-m-d H:i:s'),
                    'messages' => $transaction->messages->map(function ($message) {
                        return [
                            'wa_id' => $message->wa_id,
                            'body' => $message->body,
                            'status' => $message->status,
                            'date' => $message->updated_at->format('Y-m-d H:i:s'),
                        ];
                    }),

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
