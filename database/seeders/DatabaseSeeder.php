<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Averroes STY',
            'role'=> 'admin',
            'email' => 'admin@example.com',
            'password'=> bcrypt('admin@example.com'),
            
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Harjo',
            'role'=> 'siswa',
            'email' => 'siswa@siswa.com',
            'password'=> bcrypt('siswa@siswa.com'),
            
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Averroes JR',
            'role'=> 'bank',
            'email' => 'admin@bank.com',
            'password'=> bcrypt('admin@bank.com'),
            
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Guest Acc',
            'role'=> 'siswa',
            'email' => 'Guest@Gmail.com',
            'password'=> bcrypt('Guest@Gmail.com'),
            
        ]);
    }
}
