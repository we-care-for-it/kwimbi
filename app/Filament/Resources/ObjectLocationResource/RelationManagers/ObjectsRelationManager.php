<?php

namespace App\Filament\Resources\ObjectLocationResource\RelationManagers;

use App\Models\Elevator;
use App\Models\ObjectMaintenanceCompany;
use App\Models\ObjectType;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


//Form

//Table


class ObjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'Objects';
    protected static ?string $title = 'Gekoppelde objecten';

    public function form(Form $form): Form
    {
        return $form
            ->schema([


                Grid::make([
                    'default' => 2,

                ])
                    ->schema([


                        Forms\Components\TextInput::make("name")
                            ->label("Omschrijving"),

                        Forms\Components\TextInput::make('unit_no')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('nobo_no')
                            ->required()
                            ->maxLength(255),


                        Select::make('object_type_id')
                            ->label('Soort / Type')
                            ->options(ObjectType::where('is_active', 1)->pluck('name', 'id')),


                        Select::make('maintenance_company_id')
                            ->label('Onderhoudspartij')
                            ->options(ObjectMaintenanceCompany::
                            pluck('name', 'id')),


                    ])


            ]);


    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('unit_no')
                    ->label('Nummer')->searchable()->sortable()
                    ->placeholder('Geen unitnummer'),

                Tables\Columns\TextColumn::make('name')->badge()
                    ->label('Naam')->placeholder('-'),

                Tables\Columns\TextColumn::make('nobo_no')
                    ->label('Nobonummer')->searchable()
                    ->placeholder('Geen Nobonummer'),


                TextColumn::make('inspections_count')->counts('inspections')
                    ->label('Keuringen')
                    ->sortable()
                    ->badge()
                    ->alignment(Alignment::Center),


                TextColumn::make('maintenance_count')->counts('maintenance')
                    ->label('Onderhoudsbeurten')
                    ->sortable()
                    ->badge()
                    ->alignment(Alignment::Center),


                Tables\Columns\TextColumn::make('type.name')
                    ->label('object_type_id')->searchable()
                    ->badge()
                    ->placeholder('Onbekend'),


//                Tables\Columns\TextColumn::make('location.managementcompany.name')
//                    ->searchable()
//                    ->label('Beheerder') ->placeholder('Geen beheerder')->sortable() ,

                Tables\Columns\TextColumn::make('maintenance_company.name')
                    ->searchable()->placeholder('Geen onderhoudspartij')
                    ->sortable()
                    ->label('Onderhoudspartij'),


            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Lift toevoegen')
                    ->modalHeading('Lift toevoegen')
                    ->modalDescription('Om een lift toe te voegen en te koppelen aan deze locatie zijn er een aantal gegevens nodig ')
                ,
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Open object')->url(function (Object $record){
                    return "/admin/objects/".$record->id."/edit";

                })->icon('heroicon-c-link')

                    //->url(fn (Object $record): string => route('filament.resources.object.edit', $record))
                    //->openUrlInNewTab()
            //    Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }
}
