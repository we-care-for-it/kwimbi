<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources;

use App\Filament\Clusters\ElevatorsSettings;
use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspecectionsZincodesResource\Pages;
use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectInspecectionsZincodesResource\RelationManagers;
use App\Models\objectInspectionZincode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
 


class ObjectInspecectionsZincodesResource extends Resource
{
    protected static ?string $model = objectInspectionZincode::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = ElevatorsSettings::class;
 
    protected static ?string $title = 'Objecten - Zincodes';

    protected static ? string $navigationGroup = 'Vaste gegevens';
    protected static ? string $navigationLabel = 'ZIN codes';



    public static function form(Form $form): Form
    {
        return $form
        ->schema([

            Forms\Components\TextInput::make('code')
            ->label('Code')
            ->columnSpan('full') ,

            Forms\Components\Textarea::make('description')
            ->label('Omschrijving')
            ->columnSpan('full') 

        ]);
      

   
}
   

     public static function table(Table $table): Table
    {
        return $table
        ->columns([
 
                             



    TextColumn::make('code')->searchable()
       
            ->width(100) ,  

            TextColumn::make('description')->searchable()
            ->label('Omschrijving')   ->wrap()
          
      
        ])
        ->filters([
            Tables\Filters\TrashedFilter::make(), 

        ])
        ->actions([
           // Tables\Actions\EditAction::make()->modalHeading('Wijzigen'),
        //   Tables\Actions\DeleteAction::make()->modalHeading('Verwijderen van deze rij'),
        ])
        ->bulkActions([
           Tables\Actions\BulkActionGroup::make([
         //     Tables\Actions\DeleteBulkAction::make()->modalHeading('Verwijderen van alle geselecteerde rijen'),
   
          ]),
        ])      
         ->emptyState(view('partials.empty-state')) ;
        ;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageObjectInspecectionsZincodes::route('/'),
        ];
    }
}
