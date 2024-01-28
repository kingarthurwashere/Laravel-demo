<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperuserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Superuser',
            'email' => 'arthurnyasango@gmail.com',
            'password' => Hash::make('Wita@1998'),
        ]);
    }
}
