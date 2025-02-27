<?php

namespace App\Filament\Resources\RelationResource\RelationManagers;

use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class TasksRelationManager extends RelationManager
{
    protected static string $relationship = 'tasks';
    protected static ?string $title = 'Taken';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Titel')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Beschrijving'),
                Forms\Components\TextInput::make('priority')
                    ->label('Prioriteit')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('deadline')
                    ->label('Deadline'),
                Forms\Components\TimePicker::make('end_time')
                    ->label('Eindtijd'),
                Forms\Components\TimePicker::make('begin_time')
                    ->label('Starttijd'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->emptyState(view('partials.empty-state'))
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Titel')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Beschrijving')
                    ->limit(50),
                Tables\Columns\TextColumn::make('priority')
                    ->label('Prioriteit'),
                Tables\Columns\TextColumn::make('deadline')
                    ->label('Deadline')
                    ->date(),
                Tables\Columns\TextColumn::make('end_time')
                    ->label('Eindtijd')
                    ->time(),
                Tables\Columns\TextColumn::make('begin_time')
                    ->label('Starttijd')
                    ->time(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Taak toevoegen')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['model_id']   = $this->ownerRecord->id;
                        $data['model']      = 'relation';
                        $data['model_id']   = $this->getOwnerRecord()->id;
                        $data['company_id'] = Filament::getTenant()->id;

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('Bewerken'),
                Tables\Actions\DeleteAction::make()
                    ->label('Verwijderen'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('Geselecteerde verwijderen'),
                ]),
            ]);
    }
}