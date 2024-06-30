<?php

namespace App\Filament\Clusters\WorkorderSettings\Resources;

use App\Filament\Clusters\WorkorderSettings;
use App\Filament\Clusters\WorkorderSettings\Resources\WorkordersSolutionsResource\Pages;
use App\Filament\Clusters\WorkorderSettings\Resources\WorkordersSolutionsResource\RelationManagers;
use App\Models\workordersSolution;
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
 

class WorkordersSolutionsResource extends Resource
{
    protected static ?string $model = workordersSolution::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = WorkorderSettings::class;
    protected static ? string $navigationGroup = 'Basisgegevens';
    protected static ? string $navigationLabel = 'Oplossingen';




    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('code')
            ->required()
            ->maxLength(255)
            ->live(onBlur : true) ,

            Forms\Components\TextArea::make('solution')
                ->label('Oplossing')
                ->columnSpan('full') ,

            Forms\Components\Toggle::make('is_active')
                ->label('Zichtbaar bij werkopdrachten')
                ->default(true) , ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('is_active')
                ->label('Zichbaar')
                ->searchable()
                ->width(100) , TextColumn::make('code')
                ->label('Code')
                ->width(100) , TextColumn::make('solution')
                ->label('Oplossing')
                ->searchable() ,
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
            'index' => Pages\ManageWorkordersSolutions::route('/'),
        ];
    }
}
