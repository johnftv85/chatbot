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
        AuthorizedIp::create(['ip_address' => '104.154.206.97', 'description' => 'Servidor de pruebas']);
        AuthorizedIp::create(['ip_address' => '34.94.155.169', 'description' => 'Servidor 17']);
        AuthorizedIp::create(['ip_address' => '127.0.0.1', 'description' => 'Servidor Local']);
        AuthorizedIp::create(['ip_address' => '181.58.39.116', 'description' => 'Ip local']);
    }
}
