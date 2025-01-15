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
    protected $context;
    protected $pdf;

    /**
     * Create a new job instance.
     */
    public function __construct($cellphone, $context, $pdf = null)
    {
        $this->cellphone = $cellphone;
        $this->context = $context;
        $this->pdf = $pdf;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->api($this->cellphone, $this->context, $this->pdf);
    }
}
