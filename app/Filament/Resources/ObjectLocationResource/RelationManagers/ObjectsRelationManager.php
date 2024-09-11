<?php

namespace App\Filament\Resources\ObjectLocationResource\RelationManagers;

use App\Models\Elevator;
use App\Models\ObjectMaintenanceCompany;
use App\Models\ObjectManagementCompany;
use App\Models\ObjectType;
use App\Models\ProjectStatus;
use App\Services\AddressService;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\ObjectLocation;


//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\FileUpload;


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



                        Select::make('type_id')
                            ->label('Soort / Type')

                    ->options(ObjectType::where('is_active',1)->pluck('name', 'id')),



                        Select::make('maintenance_company_id')
                            ->label('Onderhoudspartij')

                            ->required()
                            ->reactive()
                            ->options(ObjectMaintenanceCompany::all()
                                ->pluck('name', 'id')) ,




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
                    ->label('Naam')->placeholder('-') ,

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
                    ->label('Type')->searchable()
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
