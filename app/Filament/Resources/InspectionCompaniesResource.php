<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InspectionCompaniesResource\Pages;
use App\Filament\Resources\InspectionCompaniesResource\RelationManagers;
use App\Models\inspectionCompany;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;

//Form
use Filament\Forms\Components\TextInput;
 
//tables
use Filament\Tables\Columns\TextColumn;
 



class InspectionCompaniesResource extends Resource
{
    protected static ?string $model = inspectionCompany::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Keuringinstanties';
    protected static ?string $recordTitleAttribute = 'name';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([

            
            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('general_emailaddress')
                    ->email()
                    ->label('E-mailadres')
                    ->maxLength(255),
                   
                    Forms\Components\TextInput::make('phonenumber')
                    ->label('Telefoonnummer')
                    ->maxLength(255),
              
                    Forms\Components\TextInput::make('website')
                    ->maxLength(255)
                  
                       // ->content(fn (Customer $record): ?string => $record->updated_at?->diffForHumans()),
                ])
                ->columnSpan(['lg' => 1]),
              //  ->hidden(fn (?Customer $record) => $record === null),


            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\TextInput::make('name')
                    ->label('Naam')
                        ->maxLength(255)
                        ->required(),

                    Forms\Components\TextInput::make('zipcode')
                     
                        ->label('Postcode')
                        ->maxLength(255),
                      

                    Forms\Components\TextInput::make('place')
                    ->label('Plaats')
                        ->maxLength(255),

                
                        Forms\Components\TextInput::make('address')
                        ->label('adres')
                        ->maxLength(255),
                ])
                ->columns(2)
          ->columnSpan(['lg' => 2]),

        ])
        ->columns(3);
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
                        ->alignLeft(),

                    Tables\Columns\TextColumn::make('general_emailaddress')
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
                        function (inspectionCompany $rec) {
                          return $rec->zipcode . " " . $rec->place;
                         }),
 

 


                ])->space(2),


                Tables\Columns\TextColumn::make('phonenumber')
                ->label('Telefoonnummer')
                ->searchable()
                ->sortable(),

                Tables\Columns\TextColumn::make('website')
                ->label('Website')
                ->searchable()
                ->sortable()


            ])->from('md'),
        ])
        ->filters([
            Tables\Filters\TrashedFilter::make(), 
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            
        ])
        ->groupedBulkActions([
            Tables\Actions\DeleteBulkAction::make()
                ->action(function () {
                    Notification::make()
                        ->title('Now, now, don\'t be cheeky, leave some records for others to play with!')
                        ->warning()
                        ->send();
                }),
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
            'index' => Pages\ListInspectionCompanies::route('/'),
            'create' => Pages\CreateInspectionCompanies::route('/create'),
            'edit' => Pages\EditInspectionCompanies::route('/{record}/edit'),
        ];
    }




 

}
