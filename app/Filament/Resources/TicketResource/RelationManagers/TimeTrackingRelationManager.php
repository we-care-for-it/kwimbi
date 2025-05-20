<?php
namespace App\Filament\Resources\TicketResource\RelationManagers;

use App\Models\workorderActivities;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use LaraZeus\Tiles\Tables\Columns\TileColumn;

class TimeTrackingRelationManager extends RelationManager
{
    protected static string $relationship = 'timeTracking';
    protected static ?string $label       = '';
    protected static ?string $title       = 'Activiteiten';
    protected static ?string $icon        = 'heroicon-o-clock';

    // public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    // {

    //     return in_array('Tijdregistratie', $ownerRecord?->relation->type->options) ? true : false;
    // }

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->timeTracking()->count();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('started_at')
                    ->label('Datum')
                    ->closeOnDateSelection()
                    ->default(now())
                    ->required(),
                Forms\Components\TimePicker::make('time')
                    ->label('Tijd')
                    ->seconds(false)
                    ->required(),
                Forms\Components\Select::make('work_type_id')
                    ->label('Uursoort')
                    ->searchable()
                    ->options(workorderActivities::where('is_active', 1)->pluck("name", "id")->toArray())
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Omschrijving')
                    ->autosize()
                    ->required()
                    ->columnSpan('full'),
                Forms\Components\Toggle::make('invoiceable')
                    ->label('Facturabel')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([

                TileColumn::make('')
                    ->description(fn($record) => $record->user->email)
                    ->sortable()
                    ->getStateUsing(function ($record): ?string {
                        return $record?->user?->name;
                    })
                    ->label('Medewerker')
                    ->searchable(['first_name', 'last_name'])
                    ->image(fn($record) => $record?->user?->avatar)
                    ->width('300px')
                    ->placeholder('Geen'),

                TextColumn::make('started_at')
                    ->label('Datum')
                    ->sortable()
                    ->toggleable()
                    ->width(50)
                    ->alignment(Alignment::Center)
                    ->date('d-m-Y')
                    ->placeholder('-')
                    ->searchable(),
                TextColumn::make('time')
                    ->label('Tijd')
                    ->sortable()
                    ->date('H:i')
                    ->toggleable()
                    ->placeholder('-')
                    ->width(10),
                TextColumn::make('weekno')
                    ->label('Week nr.')
                    ->width(50)
                    ->alignment(Alignment::Center)
                    ->placeholder('-')
                    ->toggleable()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('activity.name')
                    ->badge()
                    ->label('Uursoort')
                    ->placeholder('-')
                    ->toggleable()
                    ->width('200px')
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Activiteit')
                    ->wrap()
                    ->placeholder('-')
                    ->searchable(),
                ToggleColumn::make('invoiceable')
                    ->label('Facturabel')
                    ->onColor('success')
                    ->sortable()
                    ->toggleable()
                    ->offColor('danger')
                    ->width(100),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->icon('heroicon-m-plus')
                    ->modalHeading('Activiteit toevoegen')
                    ->modalIcon('heroicon-o-plus'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading('Activiteit bewerken')
                    ->tooltip('Bewerken')
                    ->label('Bewerken')
                    ->modalIcon('heroicon-m-pencil-square'),
                Tables\Actions\DeleteAction::make()
                    ->modalIcon('heroicon-o-trash')
                    ->tooltip('Verwijderen')
                    ->label('')
                    ->modalHeading('Verwijderen')
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->emptyState(view("partials.empty-state"));
    }
}
