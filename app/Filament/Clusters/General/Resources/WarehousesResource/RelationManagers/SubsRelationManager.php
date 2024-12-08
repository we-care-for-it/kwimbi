<?php

namespace App\Filament\Clusters\General\Resources\WarehousesResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
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



class SubsRelationManager extends RelationManager
{
    protected static string $relationship = 'subs';
    protected static ?string $title = 'Stelling / Rekken';
    public function form(Form $form): Form
    {
        return $form
        
        ->schema([
           
        Forms\Components\TextInput::make('name')
        ->label('Naam')
        ->columnSpan('full')->required() ,

    Forms\Components\Toggle::make('is_active')
        ->label('Zichtbaar  ')
        ->default(true) , ]);
       
}

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ToggleColumn::make('is_active')
                ->label('Zichtbaar')
                ->onColor('success')
    ->offColor('danger')     ->width(100) ,
    
                Tables\Columns\TextColumn::make('name')->label('Naam'),
            ])
            ->filters([
              ///  Tables\Filters\TrashedFilter::make()
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Toevoegen')->modalHeading('Toevoegen')   ->modalWidth(MaxWidth::Medium),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->modalHeading('Wijzig')   ->modalWidth(MaxWidth::Medium),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]));
    }
}
