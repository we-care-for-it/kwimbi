<?php

namespace App\Filament\Resources\ObjectLocationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Elevator;
use App\Models\ObjectMaintenanceCompany;
use App\Models\ObjectType;
 
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
 
 
use Filament\Support\Enums\Alignment;
 
use Filament\Tables\Columns\TextColumn;
 
use Illuminate\Database\Eloquent\Model;
use App\Enums\ElevatorStatus;



class ObjectsSameComplexRelationManager extends RelationManager
{
    protected static string $relationship = 'objects_same_complex';
    protected static ?string $title = 'Objecten is het zelfde complex';
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table


        // ->modifyQueryUsing(function (Builder $query) { 
         
        //    $query->where('location.address_id',$this->getOwnerRecord()->complexnumber); 
           
        // }) 


            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('unit_no')
                    ->label('Nummer')->searchable()->sortable()
                    ->placeholder('Geen unitnummer'),

                Tables\Columns\TextColumn::make('name') 
                    ->label('Naam')->placeholder('-'),

                Tables\Columns\TextColumn::make('nobo_no')
                    ->label('Nobonummer')->searchable()
                    ->placeholder('Geen Nobonummer'),


                TextColumn::make('elevator.inspections_count')->counts('inspections')
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


            ])->emptyState(view('partials.empty-state-small'))
            ->filters([
                //
            ])
            ->headerActions([
                     ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Open object')->url(function (Object $record){
                    return "/admin/objects/".$record->id."";

                })->icon('heroicon-c-link')

                   
                
                ->actions([
                    ActionGroup::make([
                     
                        EditAction::make(),
                        DeleteAction::make(),
                    ]),
                ])
                
                ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }
 
}
