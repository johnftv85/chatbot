<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            (object) [
                'id' => 1,
                'name' => 'Paisapan',
                'email' => 'cristianrave@pandapandistribuciones.com',
                'password' => bcrypt('Paisapan')
            ],
            (object) [
                'id' => 2,
                'name' => 'Tecnoal',
                'email' => 'Tecnoal',
                'password' => bcrypt('Tecnoal')
            ],
            (object) [
                'id' => 3,
                'name' => 'Bex soluciones',
                'email' => 'webmaster@bexsoluciones.com',
                'password' => bcrypt('Bex soluciones')
            ],
            (object) [
                'id' => 4,
                'name' => 'John Fredy Torres',
                'email' => 'j.fredytv@gmail.com',
                'password' => bcrypt('John Fredy Torres')
            ],
        ];

        foreach($users as $user) {
            User::create([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
