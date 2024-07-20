<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectsResource\Pages;
use App\Filament\Resources\ProjectsResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


use Filament\Support\Enums\FontWeight;

use Filament\Support\Enums\MaxWidth;
//Form
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;

//tables
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;

class ProjectsResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $title = 'Projecten';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                 
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Projectnaam')
                ->searchable(),

                Tables\Columns\TextColumn::make('customer.name')
                ->searchable(),

                Tables\Columns\TextColumn::make('startdate')
                ->label('Startdatum')
                ->dateTime('d-m-Y')   ,


                Tables\Columns\TextColumn::make('enddate')
                ->label('Eindddatum')
             ->dateTime('d-m-Y') ,
                                       
             Tables\Columns\TextColumn::make('description')
             ->label('Omschrijving')->weight(FontWeight::Light),

 
                                       
             Tables\Columns\TextColumn::make('status.name')
             ->label('Status')
    
             ->label('Status')->badge(),

            
            ])
            ->filters([
                SelectFilter::make('status_id')
                ->label('Status')
                ->relationship('status', 'name')
                ->searchable()
                ->preload()
                ->multiple()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\UploadsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProjects::route('/create'),
            'edit' => Pages\EditProjects::route('/{record}/edit'),
        ];
    }
}
