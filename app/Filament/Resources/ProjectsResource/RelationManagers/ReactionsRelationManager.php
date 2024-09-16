<?php

namespace App\Filament\Resources\ProjectsResource\RelationManagers;

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

    public function hasCombinedRelationManagerTabsWithForm(): bool
    {
        return true;
    }

    public function getContentTabIcon(): ?string
    {
        return 'heroicon-m-cog';
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

            Select::make("status_id")
                ->label("Status")
                ->placeholder("Huidige status")
                ->options(
                    Statuses::where("model", "Project")->pluck("name", "id")
                ),

            DateTimePicker::make("created_at")
                ->label("Invoegdatum / tijd")
                ->default(now())
                ->format("d-m-Y H:i:s"),
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
                Tables\Columns\TextColumn::make("status.name")
                    ->label("Status")
                    ->badge()
            ])
            ->filters([
                //No Filters
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data["user_id"] = auth()->id();
                        if (!$data["status_id"]) {
                            $data["status_id"] = $this->getOwnerRecord()->status_id;
                        }
                        return $data;
                    })->label("Reactie toevoegen")
                    ->after(function ($livewire) {
                    }),
            ])
            ->searchable(false)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->label(""),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([]),
            ]);
    }
}
