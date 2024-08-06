<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // User::create([
        //     'name' => 'Ransford Boakye',
        //     'firstname' => 'Ransford',
        //     'lastname' => 'Boakye',
        //     'email' => 'ransboak@gmail.com',
        //     'contact' => '0542150898',
        //     'password' => Hash::make('12345678'),
        //     'role' => 'doctor'
        // ]);

        // User::create([
        //     'name' => 'Kofi Amofah',
        //     'firstname' => 'Kofi',
        //     'lastname' => 'Amofah',
        //     'email' => 'rans@gmail.com',
        //     'contact' => '0542150898',
        //     'password' => Hash::make('12345678'),
        //     'role' => 'patient'
        // ]);

        User::create([
            'name' => 'Ransford Boakye',
            'firstname' => 'Ransford',
            'lastname' => 'Boakye',
            'email' => 'admin@gmail.com',
            'contact' => '0542150898',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);

        // Doctor::create([
        //     'user_id' => 1,
        //     'field' => 'Dentistry',
        // ]);
        User::factory(30)->create();


        User::where('role', 'doctor')->each(function ($user) {
            Doctor::factory()->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
