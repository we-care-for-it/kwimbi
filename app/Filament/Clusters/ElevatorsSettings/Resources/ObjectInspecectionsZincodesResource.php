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

    protected static ? string $navigationGroup = 'Basisgegevens';
    protected static ? string $navigationLabel = 'Zin codes';



    public static function form(Form $form): Form
    {
        return $form
        ->schema([

            Forms\Components\TextInput::make('name')
            ->label('Oplossing')
            ->columnSpan('full') ,
            Forms\Components\TextInput::make('code')
            ->required()
            ->maxLength(255)
            ->live(onBlur : true) ,

          

            
        ]);
}
   

     public static function table(Table $table): Table
    {
        return $table
        ->columns([
    TextColumn::make('code')
            ->label('Code')
            ->width(100) ,  

            TextColumn::make('name')
            ->label('name')
            ->width(100) ,  
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
        ])   ->emptyState(view('partials.empty-state')) ;
        ;;
}

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageObjectInspecectionsZincodes::route('/'),
        ];
    }
}
