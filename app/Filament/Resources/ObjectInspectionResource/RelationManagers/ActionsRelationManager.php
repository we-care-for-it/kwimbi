<?php
namespace App\Filament\Resources\ObjectInspectionResource\RelationManagers;

use App\Enums\ActionStatus;
use App\Models\Company;
use App\Models\ObjectInspectionData;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActionsRelationManager extends RelationManager
{
    protected static string $relationship = 'actions';
    protected static ?string $title       = "Acties";

    protected static bool $isLazy = false;
    public static function getBadge($ownerRecord, string $pageClass): ?string
    {

        return count($ownerRecord?->actions);

    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make("title")
                    ->columnSpan('full')
                    ->label("Titel / Omschrijving"),

                Textarea::make('body')
                    ->rows(3)
                    ->label('Uitgebreide omschrijving')

                    ->columnSpan('full')
                    ->autosize(),

                Select::make('for_user_id')

                    ->options(User::where('company_id', Filament::getTenant()->id)->pluck('name', 'id'))

                    ->searchable()
                    ->label('Medewerker')

                ,
                Select::make('company_id')

                    ->options(Company::pluck('name', 'id'))

                    ->searchable()
                    ->label('Bedrijf'),

                Select::make('status_id')

                    ->options(ActionStatus::class)
                    ->searchable()
                    ->label('Status'),

            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->getStateUsing(function ($record): ?string {
                        return sprintf('%06d', $record?->id);
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Aanmaakdatum')

                    ->dateTime("d-m-Y H:i"),

                Tables\Columns\TextColumn::make('title')
                    ->wrap()
                    ->label('Titel')

                    ->description(function ($record): ?string {

                        return $record?->body;

                    }),

                Tables\Columns\TextColumn::make('create_by_user.name')
                    ->label('Gemaakt door'),
                Tables\Columns\TextColumn::make('for_user.name')
                    ->placeholder('Niet toegekend')
                    ->label('Voor medewerker'),

                Tables\Columns\TextColumn::make('company.name')
                    ->placeholder('Niet toegekend')
                    ->label('Bedrijf'),

                Tables\Columns\TextColumn::make('status_id')
                    ->badge()
                    ->label('Status'),

                TextColumn::make("itemdata_count")
                    ->counts("itemdata")
                    ->label("Punten")
                    ->badge()
                    ->alignment(Alignment::Center)
                    ->color("success"),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                //  Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                //  ActionGroup::make([
                EditAction::make()
                    ->modalHeading('Snel bewerken')
                    ->modalIcon('heroicon-m-pencil-square')
                    ->hidden(fn($record) => $record->external_uuid)
                    ->label('Snel bewerken')

                    ->slideOver(),
                DeleteAction::make()

                    ->modalHeading("Actie verwijderen")
                    ->modalDescription(
                        "Met deze zorg je ervoor dat de actie voor dit keuringspunt verwijderd word."
                    )

                    ->modalIcon('heroicon-o-trash')
                    ->modalHeading('Keuring verwijderen')
                    ->color('danger')
                    ->label('')

                    ->action(function () {

                        ObjectInspectionData::where('action_id', $this->ownerRecord->id)->update([
                            'action_id' => null,

                        ]);

                    })

                ,

            ])->emptyState(view('partials.empty-state-small'))
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
