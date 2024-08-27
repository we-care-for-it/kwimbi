<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomersResource\Pages;
use App\Filament\Resources\CustomersResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Grid;

class CustomersResource extends Resource
{
    protected static ?string $model = Customer::class;
    protected static ?string $title = 'Relaties';
 

    
 
    protected static ? string $navigationLabel = 'Relaties';


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([

            Forms\Components\Section::make()
            ->schema([
    
                Forms\Components\TextInput::make('name')
                ->label('Relatie naam')
                ->maxLength(255) ,
    
            ]),

  
        ]);

   
               

            }


            

    public static function table(Table $table): Table
    {
        return $table
        
        ->columns([
            Tables\Columns\Layout\Split::make([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('name')
                        ->searchable()
           
                        ->weight('medium')
                        ->alignLeft()        ->label('Bedrijfsnaam'),

                    Tables\Columns\TextColumn::make('emailaddress')
                        ->label('Email address')
                        ->searchable()
                    
                        
                        ->alignLeft(),
                ])->space(),

                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\TextColumn::make('address')
                    ->searchable()
                
                    ->weight('medium')
                    ->alignLeft(),

 

                    Tables\Columns\TextColumn::make('zipcode')->state(
                        function (Customer $rec) {
                          return $rec->zipcode . " " . $rec->place;
                         }),
 

 


                ])->space(2),


                // Tables\Columns\TextColumn::make('phonenumber')
                // ->label('Telefoonnummer')
                // ->searchable()
                // ->sortable(),

   


            ])->from('md'),
        ])
            ->filters([
                Tables\Filters\TrashedFilter::make(), 
            ])
            ->actions([
                 Tables\Actions\EditAction::make()->modalHeading('Wijzigen'),
                Tables\Actions\DeleteAction::make()->modalHeading('Verwijderen van deze rij'),
     
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->modalHeading('Verwijderen van alle geselecteerde rijen'),
           
                ]),
            ]) ->emptyState(view('partials.empty-state')) ;
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\LocationsRelationManager::class,
        ];
    }
   

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomers::route('/create'),
            'edit' => Pages\EditCustomers::route('/{record}/edit'),
        ];
    }
}
