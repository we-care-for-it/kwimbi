<?php

namespace App\Filament\Clusters\Actions\Resources;

use App\Enums\ActionTypes;
use App\Filament\Clusters\Actions;
use App\Filament\Clusters\Actions\Resources\PersonalActionsResource\Pages;
use App\Models\Company;
use App\Models\Customer;
use App\Models\SystemAction;
use App\Models\user;
use Awcodes\FilamentBadgeableColumn\Components\Badge;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PersonalActionsResource extends Resource
{
    protected static ?string $model = SystemAction::class;
    protected static ?string $navigationLabel = 'Persoonlijke acties';
    protected static ?string $title = 'Persoonlijke acties';
    protected static ?int $navigationSort = 1;

    protected static ?string $cluster = Actions::class;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('for_user_id', Auth::id())->count();
    }

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

                ToggleButtons::make('private_action')
                    ->label('Prive actie')
                    ->default(1)
                    ->boolean()
                    ->grouped(),

                Select::make('type_id')
                    ->options(ActionTypes::class)
                    ->searchable()
                    ->default(1)
                    ->label('Type'),

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

                        ]),

                    ]),

                Section::make('Planning')
                    ->schema([
                        Split::make([

                            DatePicker::make('plan_date')
                                ->label('Datum'),

                            TimePicker::make('plan_time')
                                ->label('Tijd')
                                ->displayFormat('H:m'),

                        ]),

                    ]),

                Split::make([
                    Select::make('for_user_id')

                        ->options(User::pluck('name', 'id'))
                        ->searchable()
                        ->default(Auth::id())
                        ->label('Verplaatst naar medewerker'),
                ])->columns(3),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->modifyQueryUsing(function (Builder $query) {

                return $query->where('for_user_id', 1);

            })->columns([

            Tables\Columns\TextColumn::make('id')
                ->description(function ($record): ?string {
                    if ($record?->private_action) {
                        return "Priveactie";
                    } else {
                        return false;
                    }
                })
                ->label('#')
                ->sortable()
                ->getStateUsing(function ($record): ?string {
                    return sprintf('%06d', $record?->id);
                }),

            Tables\Columns\TextColumn::make('plan_date')
                ->label('Plandatum')
                ->placeholder('Geen')
                ->dateTime("d-m-Y")
                ->sortable()
                ->description(function ($record): ?string {
                    return $record->plan_time
                    ? "Plan tijd: " . date("H:i", strtotime($record?->plan_time)) : "nodate";
                }),

            Tables\Columns\TextColumn::make('title')
                ->wrap()
                ->label('Titel')
                ->description(function ($record): ?string {
                    return $record?->body;
                }),

            Tables\Columns\TextColumn::make('type_id')
                ->badge()
                ->label('Type'),

            Tables\Columns\TextColumn::make('customer.name')
                ->placeholder("Geen")
                ->label('Relatie'),

            Tables\Columns\TextColumn::make('company.name')
                ->placeholder("Geen")
                ->label('Bedrijf'),

        ])
            ->defaultSort('created_at', 'desc')
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
                    ->label('Sluiten'),

                // ->action(function () {

                //     ObjectInspectionData::where('action_id', $this->ownerRecord->id)->update([
                //         'action_id' => null,

                //     ]);

                // })

            ])

            ->filters([
                //
            ])
            ->actions([
                DeleteAction::make()

                    ->modalDescription(
                        "Weet je zeker dat je deze actie wilt voltooien ?"
                    )

                    ->modalIcon('heroicon-o-check')
                    ->modalHeading('Actie voltooien')
                    ->color('danger')
                    ->label('Sluiten'),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->emptyState(view("partials.empty-state"));
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
            'index' => Pages\ListPersonalActions::route('/'),
            //  'create' => Pages\CreatePersonalActions::route('/create'),
            //  'edit' => Pages\EditPersonalActions::route('/{record}/edit'),
        ];
    }
}
