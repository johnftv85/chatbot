<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Models\TransactionalOrder;
use App\Traits\WhatsAppApiTrait;
use Throwable;

class SendLocationToWhatsApp implements ShouldQueue
{
    use Queueable, WhatsAppApiTrait;


    public $tries = 5;
    public $backoff = 10;
    // public $timeout = 120;

    protected $cellphone;
    protected $latitude;
    protected $longitude;
    protected $name;
    protected $address;
    protected $transaction_id;

    /**
     * Create a new job instance.
     */
    public function __construct($cellphone,$latitude,$longitude,$name = null,$address = null,$transaction_id)
    {
        $this->cellphone = $cellphone;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->name = $name;
        $this->address = $address;
        $this->transaction_id = $transaction_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $this->apiLocation($this->cellphone, $this->latitude, $this->longitude,$this->name,$this->address,$this->transaction_id);
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
