<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class StandStill extends BaseWidget
{
    protected static ?int $sort = 8;
    protected int | string | array $columnSpan = '6';
    protected static ?string $heading = 'Stilstaande liften';


    public function table(Table $table): Table
    {
        return $table
            ->query(
                Project::query()->latest()
            )
            ->columns([
                // ...
            ]);
    }
}
