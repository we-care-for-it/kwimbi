<?php
namespace App\Filament\Resources\ProjectsResource\RelationManagers;

use App\Enums\TimeTrackingStatus;
use App\Models\workorderActivities;
use Filament\Forms;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class TimeTrackingRelationManager extends RelationManager
{
    protected static string $relationship = 'timeTracking';

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
                Forms\Components\Select::make('status_id')
                    ->label('Status')
                    ->options(TimeTrackingStatus::class)
                    ->default(TimeTrackingStatus::REGISTERED->value) // Changed from IN_PROGRESS to REGISTERED
                    ->required(),
                Forms\Components\Select::make('work_type_id')
                    ->label('Type')
                    ->searchable()
                    ->options(workorderActivities::where('is_active', 1)->pluck("name", "id")->toArray())
                    ->required(),
                TextArea::make('description')
                    ->label('Omschrijving')
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
                Tables\Columns\TextColumn::make('started_at')
                    ->label('Datum')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time')
                    ->label('Tijd'),

                Tables\Columns\TextColumn::make('status_id')
                    ->label('Status'),
                //      ->formatStateUsing(fn ($state) => TimeTrackingStatus::tryFrom($state)?->name()),
                Tables\Columns\TextColumn::make('workType.name')
                    ->label('Type'),
                Tables\Columns\IconColumn::make('invoiceable')
                    ->label('Facturabel')
                    ->boolean(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Omschrijving')
                    ->limit(50),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_id')
                    ->label('Status')
                    ->options(TimeTrackingStatus::class),
                Tables\Filters\SelectFilter::make('work_type_id')
                    ->label('Type')
                    ->options(workorderActivities::where('is_active', 1)->pluck("name", "id")->toArray()),
                Tables\Filters\Filter::make('invoiceable')
                    ->label('Alleen facturabel')
                    ->query(fn(Builder $query) => $query->where('invoiceable', true)),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->label(''),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
