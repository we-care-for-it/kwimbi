<?php

namespace App\Filament\App\Resources\ProjectsResource\RelationManagers;

use App\Models\Statuses;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

//Models

//Form

//Table

class ReactionsRelationManager extends RelationManager
{
    protected static string $relationship = "Reactions";
    protected static ?string $title = 'Reacties';
    protected static ?string $icon = 'heroicon-o-chat-bubble-left-right';
    protected static bool $isScopedToTenant = true;
    public function hasCombinedRelationManagerTabsWithForm(): bool
    {
        return true;
    }
 

    public function getContentTabIcon(): ?string
    {
        return 'heroicon-m-eye';
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Textarea::make("reaction")
                ->rows(7)
                ->label("Opmerking")
                ->columnSpan(3)
                ->autosize()
                ->required(),

            // Select::make("status_id")
            //     ->label("Status")
            //     ->placeholder("Huidige status")
            //     ->options(
            //         Statuses::where("model", "Project")->pluck("name", "id")
            //     ),

 
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("name")
            ->columns([
                Tables\Columns\TextColumn::make("created_at")
                    ->dateTime("d-m-Y H:i:s")
                    ->label("Toegevoegd op"),
                Tables\Columns\TextColumn::make("user.name")
                    ->label('Medewerker'),
                Tables\Columns\TextColumn::make("reaction")
                    ->label('Reactie')
                    ->grow(true)->wrap(),
       
                  ])->emptyState(view('partials.empty-state-small'))
            ->filters([
                //No Filters
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label("Reactie toevoegen")
                    ->modalHeading('Reactie toevoegen'),
            ])
            ->searchable(false)
            ->actions([
                Tables\Actions\EditAction::make()
                    ->modalHeading("Reactie wijzigen"),
                Tables\Actions\DeleteAction::make()
                ->modalHeading("Reactie verwijderen?")
                    ->label(""),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([])
                ,
            ]);
    }
}
