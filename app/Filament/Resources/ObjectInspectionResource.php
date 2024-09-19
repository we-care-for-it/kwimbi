<?php

namespace App\Filament\Resources;

use App\Enums\InspectionStatus;
use App\Filament\Resources\ObjectInspectionResource\Pages;
use App\Filament\Resources\ObjectInspectionResource\RelationManagers;
use App\Models\ObjectInspection;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;


class ObjectInspectionResource extends Resource
{
    protected static ?string $model = ObjectInspection::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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


                Tables\Columns\TextColumn::make("elevator.nobo_no")
                    ->label("Object")
                    ->sortable(),

                Tables\Columns\TextColumn::make('elevator.location.address')
                    ->label('Adres')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('elevator.location.zipcode')
                    ->label('Postcode')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('elevator.location.place')
                    ->label('Plaats')
                    ->sortable(),

                Tables\Columns\TextColumn::make('elevator.customer.name')
                    ->searchable()
                    ->label('Relatie')
                    ->placeholder('Niet gekoppeld aan relatie')
                    ->sortable()
                ,

                Tables\Columns\TextColumn::make("begindate")
                    ->dateTime("d-m-Y")
                    ->label("Begindatum")
                    ->sortable(),

                Tables\Columns\TextColumn::make("enddate")
                    ->dateTime("d-m-Y")
                    ->label("Einddatum")
                    ->sortable(),

                Tables\Columns\TextColumn::make("type")
                    ->label("Type keuring")
                    ->sortable(),

                Tables\Columns\TextColumn::make("InspectionCompany.name")
                    ->label("Onderhoudspartij")
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make("remark")
                    ->label("Opmerking")
                    ->sortable(),

                Tables\Columns\TextColumn::make("status_id")
                    ->label("Status")
                    ->badge()
                    ->sortable(),

            ])
            ->filters([

                SelectFilter::make('inspection_company_id')
                    ->relationship('InspectionCompany', 'name')
                    ->label("Onderhoudspartij"),

                SelectFilter::make('status_id')
                    ->options(InspectionStatus::class)
                    ->label("Status"),

//                SelectFilter::make('elevator.location.customer_id')
//                    ->label('Relatie')
//                    ->options(Customer::pluck("name", "id")),
//
//                SelectFilter::make('elevator.location.management_id')
//                    ->label('Beheerder')
//                    ->options(Customer::pluck("name", "id")),
//
//                SelectFilter::make('status_id')
//                    ->options(InspectionStatus::class)
//                    ->label("Status"),
//
//
//                SelectFilter::make('status_id')
//                    ->options(InspectionStatus::class)
//                    ->label("Status"),


            ])->filtersFormColumns(2)
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListObjectInspections::route('/'),
            'create' => Pages\CreateObjectInspection::route('/create'),
            'edit' => Pages\EditObjectInspection::route('/{record}/edit'),
        ];
    }
}
