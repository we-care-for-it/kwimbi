<?php

namespace App\Filament\Resources;

use App\Enums\ActionStatus;
use App\Enums\ActionTypes;
use App\Filament\Resources\ActionResource\Pages;
use App\Models\Company;
use App\Models\Customer;
use App\Models\systemAction;
use App\Models\user;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ActionResource extends Resource
{
    protected static ?string $model = systemAction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = "Acties";
    protected static ?string $pluralModelLabel = 'Acties';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make("title")
                    ->columnSpan('full')
                    ->required()
                    ->label("Titel / Omschrijving"),

                Textarea::make('body')
                    ->rows(3)
                    ->label('Uitgebreide omschrijving')

                    ->columnSpan('full')
                    ->autosize(),

                Select::make('status_id')

                    ->options(ActionStatus::class)
                    ->searchable()
                    ->default(1)
                    ->label('Status'),

                Select::make('type_id')
                    ->default(3)
                    ->options(ActionTypes::class)
                    ->searchable()
                    ->label('Soort'),

                Section::make('Toewijzing')
                    ->schema([
                        Split::make([

                            Select::make('relation_id')

                                ->options(Customer::pluck('name', 'id'))

                                ->searchable()
                                ->label('Relatie'),

                            Select::make('company_id')

                                ->options(Company::pluck('name', 'id'))

                                ->searchable()
                                ->label('Bedrijf'),

                            Select::make('for_user_id')

                                ->options(User::pluck('name', 'id'))
                                ->searchable()
                                ->default(Auth::id())
                                ->label('Medewerker'),

                        ]),
                    ]),

                Section::make('Planning')
                    ->schema([
                        Split::make([

                            DatePicker::make('plan_date')
                                ->label('Datum')
                            ,

                            TimePicker::make('plan_time')
                                ->label('Tijd')

                                ->displayFormat('H:m'),

                        ]),

                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->sortable()
                    ->getStateUsing(function ($record): ?string {
                        return sprintf('%06d', $record?->id);
                    }),

                Tables\Columns\TextColumn::make('title')
                    ->wrap()

                    ->label('Titel')

                    ->description(function ($record): ?string {

                        return $record?->body;

                    }),

                Tables\Columns\TextColumn::make('type_id')
                    ->badge()
                    ->label('Status'),

                Tables\Columns\TextColumn::make('plan_date')
                    ->label('Plandatum')
                    ->placeholder('Geen')
                    ->dateTime("d-m-Y")
                    ->sortable()->description(function ($record): ?string {

                    return $record->plan_time
                    ? "Plan tijd: " . date("H:i", strtotime($record?->plan_time))
                    : "nodate";

                }),

                // Tables\Columns\TextColumn::make('create_by_user.name')
                //     ->label('Gemaakt door'),
                Tables\Columns\TextColumn::make('for_user.name')
                    ->sortable()
                    ->placeholder('Niet toegekend')
                    ->label('Medewerker')
                ,

                // Tables\Columns\TextColumn::make('company.name')
                //     ->placeholder('Niet toegekend')
                //     ->label('Bedrijf'),

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
                    ->modalIcon('heroicon-o-pencil')
                    ->hidden(fn($record) => $record->external_uuid)
                    ->label('')

                    ->slideOver(),
                DeleteAction::make()

                    ->modalDescription(
                        "Weet je zeker dat je deze actie wilt voltooien ?"
                    )

                    ->modalIcon('heroicon-o-check')
                    ->modalHeading('Actie voltooien')
                    ->color('danger')
                    ->label('Sluiten')

                // ->action(function () {

                //     ObjectInspectionData::where('action_id', $this->ownerRecord->id)->update([
                //         'action_id' => null,

                //     ]);

                // })

                ,

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])

            ->emptyState(view("partials.empty-state"));

    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActions::route('/'),
            //  'create' => Pages\CreateAction::route('/create'),
            '//edit' => Pages\EditAction::route('/{record}/edit'),
        ];
    }
}
