<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ObjectsLocationsResource\Pages;
use App\Filament\Resources\ObjectsLocationsResource\RelationManagers;
use App\Models\objectLocation;
use App\Models\objectBuildingType;
 



use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use CreateRecord\Concerns\HasWizard;
use Filament\Tables\Filters\SelectFilter;


use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\FileUpload;
//Form
  
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;


class ObjectsLocationsResource extends Resource
{
    protected static ?string $model = objectLocation::class;
     
    protected static ? string $navigationGroup = 'Objecten';
    protected static ? string $navigationLabel = 'Locaties';  

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function form(Form $form): Form
    {
        return $form
        ->schema([

            FileUpload::make('image')
            ->image()
            ->label('Afbeelding / foto')

            ->imagePreviewHeight('250')
            ->loadingIndicatorPosition('left')
            ->panelAspectRatio('2:1')
            ->panelLayout('integrated')
            ->removeUploadedFileButtonPosition('right')
            ->uploadButtonPosition('left')
            ->uploadProgressIndicatorPosition('left')

            ->imageEditor() ,
                    Forms\Components\TextInput::make('name')
                    ->label('Naam')
                        ->maxLength(255)
                        ->required(),

                  
                       // ->content(fn (Customer $record): ?string => $record->updated_at?->diffForHumans()),
         
              //  ->hidden(fn (?Customer $record) => $record === null),


          
          
                    Forms\Components\TextInput::make('zipcode')
                     
                    ->label('Postcode')
                    ->maxLength(255),   
                  

                Forms\Components\TextInput::make('place')
                ->label('Plaats')
                    ->maxLength(255),

            
                    Forms\Components\TextInput::make('address')
                    ->label('Adres')
                    ->maxLength(255),
              

                    
 

Select::make('customer_id')
->label('Relatie')
                
->relationship(name: 'customer', titleAttribute: 'name')
->loadingMessage('Relaties laden...')
->createOptionForm([

    Forms\Components\TextInput::make('name')
        ->required(),

])   ->required(),
 


 
Select::make('building_type_id')
->label('Gebouw type')
                
->relationship(name: 'objectbuildingtype', titleAttribute: 'name')
->loadingMessage('Relaties laden...')
->createOptionForm([

    Forms\Components\TextInput::make('name')
        ->required(),

])   ->required(),
 


 

        ])
        ->columns(2);
    }

    

    public static function table(Table $table): Table
    {
        return $table
        
        ->columns([

            ImageColumn::make('image')
            ->label('')
            ->width(100),

       



             
                    
                    Tables\Columns\TextColumn::make('name')
                        ->searchable()
           
                        ->weight('medium')
                        ->alignLeft()        ->label('Locatienaam'),

                        Tables\Columns\TextColumn::make('address')
                        ->searchable()
                    
                        ->weight('medium')
                        ->alignLeft(),
 


                        Tables\Columns\TextColumn::make('zipcode')
                        ->searchable()
                    
                        ->weight('medium')
                        ->alignLeft(),
 


                        Tables\Columns\TextColumn::make('place')
                        ->searchable()
                    
                        ->weight('medium')
                        ->alignLeft(),
 

             

                Tables\Columns\TextColumn::make('objectbuildingtype.name')
                ->label('Type')
                ->searchable(),
 

               // TextColumn::make('objects_count')->counts('objects')     ->label('Objecten')


                 
 
 
        ])
            ->filters([



                SelectFilter::make('building_type_id')
                ->label('Gebouwtype')       
                ->options(objectBuildingType::all()->pluck('name', 'id')),

                
                Tables\Filters\TrashedFilter::make(), 
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->modalHeading('Wijzigen'),
                Tables\Actions\EditAction::make()->modalHeading('Wijzigen'),
           //     Tables\Actions\DeleteAction::make()->modalHeading('Verwijderen van deze rij'),
     
            ])
            ->bulkActions([
              //  Tables\Actions\BulkActionGroup::make([
             //       Tables\Actions\DeleteBulkAction::make()->modalHeading('Verwijderen van alle geselecteerde rijen'),
           
               // ]),
            ])  ->emptyState(view('partials.empty-state'));
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
            'index' => Pages\ListObjectsLocations::route('/'),
           // 'create' => Pages\CreateObjectsLocations::route('/create'),
            'edit' => Pages\EditObjectsLocations::route('/{record}/edit'),
            'view' => Pages\ViewObjectsLocations::route('/{record}'),
        ];
    }
}
