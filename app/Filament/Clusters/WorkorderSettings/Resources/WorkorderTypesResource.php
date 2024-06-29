<?php

namespace App\Filament\Clusters\WorkorderSettings\Resources;

use App\Filament\Clusters\WorkorderSettings;
use App\Filament\Clusters\WorkorderSettings\Resources\WorkorderTypesResource\Pages;
use App\Filament\Clusters\WorkorderSettings\Resources\WorkorderTypesResource\RelationManagers;
use App\Models\workType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;

//tables
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
 
 

class WorkorderTypesResource extends Resource
{
    protected static ?string $model = workType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    
    protected static ?string $navigationLabel = 'Werkomschrijvingen';
    protected static ? string $navigationGroup = 'Basisgegevens';
    protected static ?string $recordTitleAttribute = 'name';
 



    protected static ?string $cluster = WorkorderSettings::class;


    public static function form(Form $form): Form
    {
        return $form
 
                 
                    ->schema([
                        Forms\Components\TextInput::make('name')
                        ->label('Naam')
                            ->maxLength(255)
                            ->required(),
    
       

                                Forms\Components\TextArea::make('description')
                                ->label('Omschrijving')
                                ->columnSpan('full') ,

                                
                            Forms\Components\TimePicker::make('default_minutes')
                            ->displayFormat('H:i')
                            ->hoursStep(1)
                            ->minutesStep(5)
                            ->label('Standaard tijd '),
                   

    
                            Forms\Components\Toggle::make('is_active')
                            ->label('Zichtbaar  ')
                            ->onColor('success')
    ->offColor('danger')
                            ->default(true) , 
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        ]);


                            
                        }
                    
      
   
                        public static function table(Table $table): Table
                        {
                            return $table
                                ->columns([
                                    ToggleColumn::make('is_active')
                                    ->label('Zichbaar')
                                    ->onColor('success')
                        ->offColor('danger')
                     
                          
                                    ->width(100),
                    
                                    TextColumn::make('name')
                                ->label('Naam')
                                ->searchable() ,
                    
                                TextColumn::make('description')
                                ->label('Omschrijving')
                                ->searchable() ,
                    
                                TextColumn::make('default_minutes')
                                ->label('Standaardtijd')
                                ->dateTime($format = 'H:i')
                                
                       
                                ->searchable() ,
                    
                    
                                ])
                                ->filters([
                                    Tables\Filters\TrashedFilter::make(), 
                                ])
                                ->actions([
                                    Tables\Actions\EditAction::make(),
                                    Tables\Actions\DeleteAction::make(),
                                ])
                                ->bulkActions([
                                    Tables\Actions\BulkActionGroup::make([
                                        Tables\Actions\DeleteBulkAction::make()->label('Toevoegen'),
                                    ]),
                                ]);
                        }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageWorkorderTypes::route('/'),
        ];
    }
}
