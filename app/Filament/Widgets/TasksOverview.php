<?php
namespace App\Filament\Widgets;

use App\Models\Task;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TasksOverview extends BaseWidget
{
    protected int|string|array $columnSpan = 'full'; // Span the widget across the full width
    protected static ?int $sort                = 80;
    protected static ?string $heading          = "Taken Overzicht";
    protected static bool $isLazy              = false;
    protected static ?string $maxHeight        = '600px';

    public function table(Table $table): Table
    {
        return $table
            ->query(Task::orderby('created_at', 'desc')->limit(10))
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable()
                    ->getStateUsing(function ($record): ?string {
                        return sprintf('%06d', $record?->id);
                    }),

                Tables\Columns\TextColumn::make('title')
                    ->label('Titel')
                    ->placeholder('-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('related_to')
                    ->label('Gerelateerd  aan')
                    ->getStateUsing(function ($record): ?string {
                        switch ($record->model) {
                            case 'relation':
                                return $record?->related_to?->name;
                                break;
                            case 'project':
                                return $record?->related_to?->name;
                                break;
                            case 'location':
                                $housenumber   = "";
                                $complexnumber = "";
                                $name          = "";
                                if ($record->related_to?->housenumber) {
                                    $housenumber = " " . $record->related_to->housenumber;
                                }
                                return $record?->related_to->address . " " . $housenumber . " - " . $record->related_to?->zipcode . " - " . $record->related_to?->place;
                                break;
                            case 'object':
                                return $record->related_to->nobo_no;
                                break;
                            case 'contactperson':
                                return $record?->related_to?->first_name . " " . $record->related_to?->last_name;
                                break;
                            default:
                                return "-";
                        }
                    })->placeholder('-'),

                Tables\Columns\TextColumn::make('begin_date')
                    ->label('Begindatum')
                    ->placeholder('-')
                    ->date('d-m-Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('deadline')
                    ->label('Einddatum')
                    ->placeholder('-')
                    ->date('d-m-Y')
                    ->color(fn($record) => strtotime($record?->deadline) < time() ? 'danger' : 'success')
                    ->sortable(),

                Tables\Columns\TextColumn::make('employee.name')
                    ->label('Toegewezen aan')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make('priority')
                    ->label('Prioriteit')
                    ->placeholder('-')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        '1'                => 'danger',  // Hoog
                        '2'                => 'warning', // Gemiddeld
                        '3'                => 'success', // Laag
                        default            => 'gray',
                    }),
            ])
            ->emptyState(view("partials.empty-state"))
            ->filters([
                // Add filters if needed
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Snel bewerken')
                    ->tooltip('Bewerken')
                    ->modalIcon('heroicon-m-pencil-square')
                    ->slideOver(),

                Tables\Actions\DeleteAction::make()
                    ->modalDescription('Weet je zeker dat je deze taak wilt verwijderen?')
                    ->modalIcon('heroicon-o-trash')
                    ->modalHeading('Taak verwijderen')
                    ->color('danger')
                    ->tooltip('Verwijderen'),
            ])
            ->defaultSort('begin_date', 'asc'); // Sort by begin date by default
    }
}
