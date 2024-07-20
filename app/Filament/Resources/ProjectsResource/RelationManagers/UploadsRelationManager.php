<?php

namespace App\Filament\Resources\ProjectsResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;

use App\Models\uploadType;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\TextInput;
 
class UploadsRelationManager extends RelationManager
{
    protected static string $relationship = 'uploads';
    protected static ?string $title = 'Bijlages';
 
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->columnSpan('full'),

                    TextInput::make('module_id')->default('1')->hidden(),
 
Textarea::make('description') ->columnSpan('full')->label('Omschrijving'),


 
FileUpload::make('filename')->label('Bestand')
->columnSpan('full'),

Select::make('upload_type_id')
    ->label('Type')
    ->options(uploadType::where('visible_projects',1)->pluck('name', 'id'))
 
 


            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([

                Tables\Columns\TextColumn::make('Naam')
                ->searchable(),

                                                
             Tables\Columns\TextColumn::make('description')
             ->label('Omschrijving')->weight(FontWeight::Light),


             Tables\Columns\TextColumn::make('type.name')
             ->label('Status')


            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Toevoegen'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
