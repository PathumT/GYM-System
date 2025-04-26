<?php

namespace Database\Seeders;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Admin',
                'email' => 'admin@itsolutionstuff.com',
                'admin' => '1',
                'age' => '0',
                'admission_fee' => '0',
                'admission_no' => '0',
                'gender' => '0',
                'phone' => '0712345678',
                'address' => 'Colombo',
                'role' => '1',
                'registered_at' => '2024.04.19',

                'password' => bcrypt('123456'),
            ],

        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }

       
    }
}
