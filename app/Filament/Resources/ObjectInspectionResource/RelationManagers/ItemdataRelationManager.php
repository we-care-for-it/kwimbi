<?php

namespace App\Filament\Resources\ObjectInspectionResource\RelationManagers;

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
use Filament\Forms\Components\Select;


class ItemdataRelationManager extends RelationManager
{
    protected static string $relationship = 'itemdata';
    protected static ?string $title = "Keuringspunten";


    public function form(Form $form): Form
    {
        return $form
            ->schema([
              TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('zin_code')
                ->label("Code"),
                Tables\Columns\TextColumn::make('comment')
                ->label("Opmerking"),

                Tables\Columns\TextColumn::make('type')
                ->label("Type"),


                Tables\Columns\TextColumn::make('status')
                ->label("Type")->badge()->placeholder("-")->color("warning"),

             
    


                // Tables\Columns\TextColumn::make('if_match')
                // ->badge()
                // ->getStateUsing(fn ($record): string => $record->if_match ? 'Published' : 'Draft')
                // ->colors([
                //     'success' => 'Published',
                // ]),

                // Tables\Columns\TextColumn::make('if_match')
                // ->badge()
                // ->getStateUsing(fn ($record): string => $record->published_at?->isPast() ? 'Published' : 'Draft')
                // ->colors([
                //     'success' => 'Published',
                // ]),

            ])   ->paginated(false)
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Toevoegen'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconbutton(),
                Tables\Actions\DeleteAction::make()->iconbutton(),

              

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
