<?php

namespace App\Filament\Clusters\General\Resources;

use App\Filament\Clusters\General;
use App\Filament\Clusters\General\Resources\UploadsTypesResource\Pages;
use App\Filament\Clusters\General\Resources\UploadsTypesResource\RelationManagers;
use App\Models\uploadType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Support\Enums\MaxWidth;

//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;



class UploadsTypesResource extends Resource
{
    protected static ?string $model = uploadType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = General::class;

     
    protected static ? string $navigationGroup = 'Basisgegevens';
    protected static ? string $navigationLabel = 'Upload types';


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
            ->onColor('success')
->offColor('danger')

            ->width(50),
            TextColumn::make('name')->searchable()
            ->label('Omschrijving')
         
      
        ])
        ->filters([
            Tables\Filters\TrashedFilter::make(), 

        ])
        ->actions([
           Tables\Actions\EditAction::make()->modalHeading('Wijzigen')->modalWidth(MaxWidth::Large),
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
            'index' => Pages\ManageUploadsTypes::route('/'),
        ];
    }
}
