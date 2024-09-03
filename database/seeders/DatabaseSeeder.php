<?php

namespace Database\Seeders;

 
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'sysadmin',
            'email' => 'sysadmin@liftindex.nl',
            'password' => Hash::make('!Timmer2024@')
        ]);

     
 
    }
}
