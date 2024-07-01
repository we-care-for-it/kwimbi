<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources;

use App\Filament\Clusters\ElevatorsSettings;
use App\Filament\Clusters\ElevatorsSettings\Resources\ElevatorsTypesResource\Pages;
use App\Filament\Clusters\ElevatorsSettings\Resources\ElevatorsTypesResource\RelationManagers;
use App\Models\objectType;
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
 

class ElevatorsTypesResource extends Resource
{
    protected static ?string $model = objectType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = ElevatorsSettings::class;

    protected static ?string $title = 'Objecten - Types';

    protected static ? string $navigationGroup = 'Basisgegevens';
    protected static ? string $navigationLabel = 'Types';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Omschrijving')
                ->columnSpan('full') ,

                Forms\Components\Toggle::make('is_active')
                ->label('Zichtbaar  ')
                ->default(true)
            ]);
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
            'index' => Pages\ManageElevatorsTypes::route('/'),
        ];
    }
}
