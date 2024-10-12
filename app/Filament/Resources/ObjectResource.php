<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjectResource\Pages;
use App\Filament\Resources\ObjectResource\RelationManagers;
use App\Models\Elevator;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Awcodes\FilamentBadgeableColumn\Components\BadgeableColumn;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationGroup;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

//Form

//Table


class ObjectResource extends Resource
{
    protected static ?string $model = Elevator::class;

    protected static ?string $navigationIcon = 'heroicon-m-arrow-up-on-square-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('unit_no')
                    ->label('Nummer')->searchable()->sortable()
                    ->placeholder('Geen unitnummer'),

                Tables\Columns\TextColumn::make('name')->badge()
                    ->label('Naam')->placeholder('-'),

                Tables\Columns\TextColumn::make('nobo_no')
                    ->label('Nobonummer')->searchable()
                    ->placeholder('Geen Nobonummer'),

                Tables\Columns\TextColumn::make('location')
                    ->getStateUsing(function (Elevator $record): ?string {
                        if ($record?->location->name) {
                            return $record?->location->name;
                        } else {
                            return $record->location->address . " - " . $record->location->zipcode . " " . $record->location->place;
                        }
                    })
                    ->searchable()
                    ->label('Locatie')
                    ->description(function (Elevator $record) {

                        if (!$record?->location->name) {
                            return $record?->location->name;
                        } else {
                            return $record->location->address . " - " . $record->location->zipcode . " " . $record->location->place;
                        }


                    }
                    ),

                Tables\Columns\TextColumn::make('location.address')
                    ->label('Adres')->searchable()->sortable()->hidden(true),

                Tables\Columns\TextColumn::make('location.zipcode')
                    ->label('Postcode')->searchable()->hidden(true),

                Tables\Columns\TextColumn::make('location.place')
                    ->label('Plaats')->searchable(),


                Tables\Columns\TextColumn::make('customer.name')
                    ->searchable()
                    ->label('Relatie')->placeholder('Niet gekoppeld aan relatie')->sortable(),

                Tables\Columns\TextColumn::make('management_company.name')
                    ->searchable()
                    ->label('Beheerder')->placeholder('Geen beheerder')->sortable(),

                Tables\Columns\TextColumn::make('maintenance_company.name')
                    ->searchable()->placeholder('Geen onderhoudspartij')
                    ->sortable()
                    ->label('Onderhoudspartij'),


            ])
            ->filters([
                //
            ])
            ->actions([
                //  Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\IncidentsRelationManager::class,


         //   RelationGroup::make('Onderhoud', [
                RelationManagers\MaintenanceContractsRelationManager::class,
                RelationManagers\MaintenanceVisitsRelationManager::class,
          //  ]),
        RelationManagers\inspectionsRelationManager::class,

          RelationManagers\AttachmentRelationManager::class,

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObjects::route('/'),
            'create' => Pages\CreateObject::route('/create'),
            'edit' => Pages\EditObject::route('/{record}/edit'),
        ];
    }
}
