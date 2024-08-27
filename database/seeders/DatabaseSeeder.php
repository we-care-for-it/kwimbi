<?php

namespace Database\Seeders;

use App\Models\Admin;
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
        $user = User::factory()->create([
            'name' => 'Systeem Administartor',
            'email' => 'sysadmin@lts-liftbeheer.nl',
            'password' => Hash::make('LTSBeheer2024@'),


        ]);

 
        

       
    }
}
