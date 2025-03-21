<?php
namespace App\Filament\Resources\ObjectResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ObjectMonitoringRelationManager extends RelationManager
{
    protected static string $relationship = 'getMonitoringEvents';

    public function form(Form $form): Form
    {
        return $form->schema([]);
        //
    }

    public function table(Table $table): Table
    {
        return $table
            ->paginated([30])
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('date_time')
                    ->label('Datum Tijd')
                    ->date('d-M-Y H:i:s'),

                Tables\Columns\TextColumn::make('category')
                    ->label('Categorie'),

                Tables\Columns\TextColumn::make('param01')
                    ->label('Verdieping'),

                Tables\Columns\TextColumn::make('param02')
                    ->label('Nummer'),

                Tables\Columns\TextColumn::make('brand')
                    ->label('Merk'),

                Tables\Columns\TextColumn::make('value')
                    ->label('Waarde'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
