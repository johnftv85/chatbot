<?php

namespace App\Jobs;

use App\Models\TransactionalOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Traits\WhatsAppApiTrait;
use Throwable;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, WhatsAppApiTrait;

    public $tries = 5;
    public $backoff = 10;
    // public $timeout = 120;

    protected $cellphone;
    protected $message;
    protected $attachment;
    protected $transaction_id;

    /**
     * Create a new job instance.
     */
    public function __construct($cellphone, $message, $attachment = null, $transaction_id)
    {
        $this->cellphone = $cellphone;
        $this->message = $message;
        $this->attachment = $attachment;
        $this->transaction_id = $transaction_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->api($this->cellphone, $this->message, $this->attachment, $this->transaction_id);
        } catch (\Exception $e) {
            Log::error('Error en SendMessageJob: ' . $e->getMessage());

            throw $e;
        }
    }

    public function failed(Throwable $exception)
    {
        Log::error("El Job de enviar mensaje ha fallado definitivamente: {$exception->getMessage()}");

        $transaction = TransactionalOrder::find($this->transaction_id);
        if ($transaction) {
            $transaction->status = '3';
            $transaction->save();
        }
    }
}
