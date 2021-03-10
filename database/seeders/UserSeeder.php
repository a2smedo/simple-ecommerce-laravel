<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Ahmed Salah',
            'email' => 'suber_admin@shop.com',
            'password' => Hash::make('123'),
            'rule_id' => 1,
            'country' => 'Egypt',
            'city' => 'Cairo',
            'phone' => '01123376466',
            'address' => 'test',
        ]);
    }
}
