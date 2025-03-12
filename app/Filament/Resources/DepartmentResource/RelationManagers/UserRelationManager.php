<?php

namespace App\Filament\Resources\DepartmentResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class UserRelationManager extends RelationManager
{
    protected static string $relationship = 'users';

    public function table(Table $table): Table
    {
        return $table
            ->defaultPaginationPageOption(100)
            ->paginated([25, 50, 100, 'all'])
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name'),
            ]);
    }

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return 'Medewerkers';
    }

    protected static function getModelLabel(): ?string
    {
        return 'Medewerker';
    }
}
