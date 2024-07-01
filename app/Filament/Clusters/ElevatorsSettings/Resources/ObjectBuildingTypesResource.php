<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources;

use App\Filament\Clusters\ElevatorsSettings;
use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectBuildingTypesResource\Pages;
use App\Filament\Clusters\ElevatorsSettings\Resources\ObjectBuildingTypesResource\RelationManagers;
use App\Models\objectBuildingType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;



class ObjectBuildingTypesResource extends Resource
{
    protected static ?string $model = objectBuildingType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = ElevatorsSettings::class;

    
      protected static ? string $navigationGroup = 'Locaties';
    protected static ? string $navigationLabel = 'Gebouwtypes';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
      
                    Forms\Components\TextInput::make('name')
                    ->label('Naam')
                    ->columnSpan('full') ,

                    Forms\Components\Toggle::make('is_active')
                    ->label('Zichtbaar  ')
                    ->default(true) , ]);
    }

  
    public static function table(Table $table): Table
    {
        return $table
        ->columns([
  

            ToggleColumn::make('is_active')
            ->label('Zichbaar')
      
            ->width(50),

            TextColumn::make('name')->searchable()
            ->label('Omschrijving')
            
      
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
        ])      
         ->emptyState(view('partials.empty-state')) ;
        ;
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageObjectBuildingTypes::route('/'),
        ];
    }
}
