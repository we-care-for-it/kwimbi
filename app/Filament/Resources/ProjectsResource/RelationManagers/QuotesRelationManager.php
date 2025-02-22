<?php
namespace App\Filament\Resources\ProjectsResource\RelationManagers;

use App\Enums\QuoteTypes;
use App\Models\Statuses;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class QuotesRelationManager extends RelationManager
{
    protected static string $relationship = 'quotes';
    protected static ?string $title       = 'Offertes';
    protected static ?string $icon        = 'heroicon-o-currency-euro';

    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        // $ownerModel is of actual type Job
        return $ownerRecord->quotes->count();
    }

    public function form(Form $form): Form
    {
        return $form->schema([Section::make()
                ->schema([

                    Select::make("type_id")
                        ->label("Type")
                        ->required()
                        ->reactive()
                        ->options(QuoteTypes::class)
                        ->columnSpan("full")
                        ->default('1'),

                    Select::make("company_id")
                        ->relationship(name: 'supplier', titleAttribute: 'name')
                        ->label('Leverancier')
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')->label('Naam van de leveracnier')->required(),

                        ])->columnSpan("full"),
                    TextInput::make("number")
                        ->label("Nummer")
                        ->placeholder('-'),

                    TextInput::make("Price")
                        ->label("Prijs")
                        ->placeholder('-')
                        ->numeric()
                        ->prefix('€'),

                ])
                ->columns(2)
                ->columnSpan(1),

            Section::make()
                ->schema([

                    DatePicker::make("request_date")
                        ->default(now())
                        ->label("Aanvraagdatum")
                        ->required(),

                    DatePicker::make("remembered_at")
                        ->label("Herindering op")
                        ->placeholder('-'),

                    DatePicker::make("accepted_at")
                        ->label("Geaccpteerd op")
                        ->placeholder('-'),

                    DatePicker::make("end_date")
                        ->label("Einddatum"),

                    Select::make("status_id")
                        ->label("Status")
                        ->required()
                        ->reactive()
                        ->options(Statuses::where("model", "ProjectQuotes")
                                ->pluck("name", "id"))
                        ->columnSpan("full"),

                ])
                ->columns(2)
                ->columnSpan(1),

            Section::make()
                ->schema([Forms\Components\TextInput::make("remark")
                        ->label("Opmerking")
                        ->maxLength(255)
                        ->columnSpan("full"),
                ])
                ->columns(2)
                ->columnSpan(2),

            Section::make()->schema([FileUpload::make('attachment')
                    ->label('Bijlage')
                    ->columnSpan(3)
                    ->preserveFilenames()
                    ->visibility('private')->directory(function () {
                    $parent_id = $this->getOwnerRecord()->id;
                    return '/uploads/project/' . $parent_id . '/quotes';
                })])->columns(2)
                ->columnSpan(2),

        ]);

    }

    public function table(Table $table):
    Table {
        return $table->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make("request_date")
                    ->dateTime("d-m-Y")
                    ->label("Offertedatum"), Tables\Columns\TextColumn::make("number")
                    ->label('Nummer'),

                Tables\Columns\TextColumn::make("supplier.name")
                    ->label("Leverancier")
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make("status.name")
                    ->label("Status")
                    ->badge()
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make("price")
                    ->label("Prijs")
                    ->prefix('€')
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make("remembered_at")
                    ->label("Herinnering verstuurd")
                    ->dateTime("d-m-Y")
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make("accepted_at")
                    ->label("Accepteer datum ")
                    ->dateTime("d-m-Y")
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make("end_date")
                    ->label("Einddatum")
                    ->dateTime("d-m-Y")
                    ->placeholder('-'),

                Tables\Columns\TextColumn::make("type_id")
                    ->label("Type")
                    ->badge(),
            ])->emptyState(view('partials.empty-state-small'))
            ->filters([
                //
            ])
            ->headerActions([Tables\Actions\CreateAction::make()
                    ->label("Offerte toevoegen")
                    ->modalWidth(MaxWidth::SixExtraLarge)])
            ->actions([

                Tables\Actions\EditAction::make()
                    ->modalWidth(MaxWidth::SixExtraLarge), Tables\Actions\DeleteAction::make()
                    ->label('')])
            ->bulkActions([
                //                Tables\Actions\BulkActionGroup::make([
                //                    Tables\Actions\DeleteBulkAction::make(),
                //                ]),
            ]);
    }
}
