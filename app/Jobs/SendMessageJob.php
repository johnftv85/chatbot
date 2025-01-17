<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\WhatsAppApiTrait;

class SendMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, WhatsAppApiTrait;

    protected $cellphone;
    protected $message;
    protected $pdf;

    /**
     * Create a new job instance.
     */
    public function __construct($cellphone, $message, $pdf = null)
    {
        $this->cellphone = $cellphone;
        $this->message = $message;
        $this->pdf = $pdf;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->api($this->cellphone, $this->message, $this->pdf);
    }
}
