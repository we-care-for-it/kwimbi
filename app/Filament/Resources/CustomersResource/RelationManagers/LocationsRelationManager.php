<?php

namespace App\Filament\Resources\CustomersResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



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
use Filament\Forms\Components\Grid;


class LocationsRelationManager extends RelationManager
{
    protected static string $relationship = 'Locations';

    public function form(Form $form): Form
    {
        return $form
            ->schema([Forms\Components\Section::make()
            ->schema([

        Grid::make(4)
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

        Textarea::make('description')
            ->rows(7)
            ->label('Opmerking')
            ->columnSpan(3)
            ->autosize() ,

        // ...
        ]) ,

        // ...
        ]) ,

        Forms\Components\Section::make()
            ->schema([

        Forms\Components\TextInput::make('address')
            ->label('Adres')
            ->maxLength(255) , Forms\Components\TextInput::make('zipcode')

            ->label('Postcode')
            ->maxLength(255) ,

        Forms\Components\TextInput::make('place')
            ->label('Plaats')
            ->maxLength(255) ,

        ])

        
            ->columnSpan(['lg' => 1]) ,

        Forms\Components\Section::make()
            ->schema([

        Select::make('customer_id')
            ->label('Relatie')

            ->relationship(name : 'customer', titleAttribute : 'name')
            ->loadingMessage('Relaties laden...')
            ->columnSpan('full')
            ->required() ,

        Select::make('management_id')
            ->label('Beheerder')
            ->columnSpan('full')

            ->relationship(name : 'managementcompany', titleAttribute:
            'name')
                ->loadingMessage('Beheerders laden...') ,

            Select::make('building_type_id')
                ->label('Gebouw type')

                ->relationship(name:
                'objectbuildingtype', titleAttribute:
                    'name')
                        ->loadingMessage('Relaties laden...')
                        ->columnSpan('full')

                    ])
                        ->columns(2)
                        ->columnSpan(['lg' => 1]) ,

                    // Forms\Components\Section::make()
                    //     ->schema([
                    // Select::make('status_id')
                    //     ->label('Status')
                    //     ->columnSpan('full')
                    //     ->required()
                    //     ->options(objectLocation::all()
                    //     ->pluck('name', 'id')) ,
                    

                    // ])
                    //     ->columns(2)
                    //     ->columnSpan(['lg' => 1]) ,
                    ])
                        ->columns(3);

                }
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('image')
                ->label('')
                ->width(100) ,

            Tables\Columns\TextColumn::make('name')
            

                ->alignLeft()
                ->label('Locatienaam') ,

            Tables\Columns\TextColumn::make('address')
          

        
                ->alignLeft() ,

            Tables\Columns\TextColumn::make('zipcode')
              

               
                ->alignLeft() ,

            Tables\Columns\TextColumn::make('place')
              
                
                ->alignLeft() ,

 

                Tables\Columns\TextColumn::make('managementcompany.name')
   
                ->label('Beheerder'),

            Tables\Columns\TextColumn::make('objectbuildingtype.name')->badge()
                ->label('Type')
          

          
            ])
            ->filters([
                //
            ])
            ->headerActions([
            //    Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
         //       Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
            //        Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
