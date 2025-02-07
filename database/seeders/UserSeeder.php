<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'name' => 'webmaster@bexsoluciones.com',
                'email' => 'webmaster@bexsoluciones.com',
                'password' => 'Bexsoluciones'
            ],
            (object) [
                'id' => 2,
                'name' => 'super@bexsoluciones.com',
                'email' => 'super@bexsoluciones.com',
                'password' => 'Bexsuper'
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
