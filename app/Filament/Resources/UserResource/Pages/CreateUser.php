<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    // protected function handleRecordCreation(array $data): User
    // {
    //     $email = $data['email'];

    //     if (User::where('email', $email)->exists()) {
    //         $user = User::firstWhere('email', $email);
    //     } else {
    //         $user = static::getModel()::create($data);
    //     }

    //     $user->companies()->attach(Filament::getTenant()->id);

    //     return $user;
    // }
}
