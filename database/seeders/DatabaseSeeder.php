<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'name' => 'Nabb',
        ], [
            'email' => 'nabb@local.admin',
            'password' => Hash::make('Th3-Cr34t0r=4ndTh30nLy0n3'),
        ]);
    }
}
