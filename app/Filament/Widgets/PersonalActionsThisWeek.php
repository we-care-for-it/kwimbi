<?php
namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\Auth;

class PersonalActionsThisWeek extends BaseWidget
{

    protected static ?string $heading          = "Mijn acties";
    protected int|string|array $columnSpan = '6';
    protected static ?string $maxHeight        = '300px';
    protected static bool $isLazy              = false;
    protected static ?int $sort                = 7;

    public function table(Table $table): Table
    {

        $status_id = null;

        return $table

            ->query(
                Task::where('employee_id', Auth::id())
                    ->limit(10)
            )->columns([

            Tables\Columns\TextColumn::make('private')
                ->label('Plandatum')
                ->placeholder('Geen')
                ->sortable()
                ->dateTime("d-m-Y")
                ->sortable(),

            Tables\Columns\TextColumn::make('title')
                ->sortable()
                ->wrap()
                ->label('Omschrijving'),

            Tables\Columns\TextColumn::make('type_id')
                ->badge()
                ->sortable()
                ->label('Type'),

            // Tables\Columns\TextColumn::make('customer.name')
            //     ->sortable()

            //     ->placeholder("Geen")
            //     ->label('Relatie'),

            // Tables\Columns\TextColumn::make('company.name')
            //     ->sortable()
            //     ->placeholder("Geen")
            //     ->label('Bedrijf'),

        ])->actions(
            [DeleteAction::make()

                    ->modalDescription(
                        "Weet je zeker dat je deze actie wilt voltooien ?"
                    )

                    ->modalIcon('heroicon-o-check')
                    ->modalHeading('Actie voltooien')
                    ->color('danger')
                    ->label('Voltooien')]
        )
            ->defaultSort('created_at', 'desc')
            ->emptyState(view("partials.empty-state"))
            ->paginated(false);
    }

}
