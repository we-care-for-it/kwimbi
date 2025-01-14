<?php

namespace App\Filament\Widgets;

use App\Models\Elevator;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\SystemAction;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\DeleteAction;
class ActionsAllUser extends BaseWidget
{

    protected static ?string $heading = "Alle acties";
    protected int|string|array $columnSpan = '6';
    protected static ?string $maxHeight = '300px';
    protected static bool $isLazy = false;
    protected static ?int $sort = 8;

    public function table(Table $table): Table
    {

        $status_id = null;
        
                 return $table

                ->query(
                    SystemAction::where('private','!=', '')
                    ->whereNot('for_user_id', Auth::id()     )  
                         ->limit(10)
                )->columns([

            Tables\Columns\TextColumn::make('body')
                ->sortable()
                ->wrap()
                ->label('Titel'),

            Tables\Columns\TextColumn::make('type_id')
                ->badge()
                ->sortable()
                ->label('Type'),

            Tables\Columns\TextColumn::make('customer.name')
                ->sortable()
           
                ->placeholder("Geen")
                ->label('Relatie'),

            Tables\Columns\TextColumn::make('company.name')
                ->sortable()
                ->placeholder("Geen")
                ->label('Bedrijf'),

        ])->actions(
            [       DeleteAction::make()

            ->modalDescription(
                "Weet je zeker dat je deze actie wilt voltooien ?"
            )

            ->modalIcon('heroicon-o-check')
            ->modalHeading('Actie voltooien')
            ->color('danger')
            ->label('Voltooien'),]
        )
            ->defaultSort('created_at', 'desc')
            ->emptyState(view("partials.empty-state"))
            ->paginated(false);
    }

}
