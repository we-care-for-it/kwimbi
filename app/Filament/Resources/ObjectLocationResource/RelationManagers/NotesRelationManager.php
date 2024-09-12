<?php

namespace App\Filament\Resources\ObjectLocationResource\RelationManagers;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class NotesRelationManager extends RelationManager
{
    protected static string $relationship = 'Notes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('note')
                    ->rows(7)
                    ->label('Notitie')
                    ->columnSpan(3)
                    ->autosize(),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Toegevoegd op'),
                Tables\Columns\TextColumn::make('user.name')->label('Medewerker'),
                Tables\Columns\TextColumn::make('note')->wrap()->label('Notitie'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->mutateFormDataUsing(function (array $data): array {
                    $data['user_id'] = auth()->id();
                    $data['model'] = "ObjectLocation";
                    return $data;
                }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
