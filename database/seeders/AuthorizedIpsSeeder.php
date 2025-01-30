<?php

namespace Database\Seeders;

use App\Models\AuthorizedIp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorizedIpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AuthorizedIp::create(['ip_address' => '192.168.1.1', 'description' => 'Servidor interno']);
        AuthorizedIp::create(['ip_address' => '35.226.95.247', 'description' => 'Servidor 20']);
        AuthorizedIp::create(['ip_address' => '127.0.0.1', 'description' => 'Servidor Local']);
    }
}
