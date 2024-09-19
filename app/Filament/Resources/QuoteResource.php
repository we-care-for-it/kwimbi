<?php

namespace App\Filament\Resources;

use App\Enums\QuoteTypes;
use App\Filament\Resources\QuoteResource\Pages;
use App\Filament\Resources\QuoteResource\RelationManagers;
use App\Models\Quote;
use App\Models\Statuses;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\VerticalAlignment;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class QuoteResource extends Resource
{
    protected static ?string $model = Quote::class;
    protected static ?string $title = 'Offertes';
    protected static ?string $navigationIcon = 'heroicon-o-currency-euro';
    protected static ?string $SearchResultTitle = "Offertes";
    protected static ?string $navigationGroup = "Hoofdmenu";
    protected static ?string $navigationLabel = "Offertes";
    protected static bool $isLazy = false;


    public static function getBadge(Model $ownerRecord, string $pageClass): ?string
    {
        // $ownerModel is of actual type Job
        return $ownerRecord->quotes->count();
    }

    public static function form(Form $form): Form
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
                    ->options(Supplier::all()
                        ->pluck("name", "id"))->createOptionForm([
                        Forms\Components\TextInput::make('name')


                    ])->columnSpan("full"),
                TextInput::make("number")
                    ->label("Nummer")
                    ->placeholder('-'),


                TextInput::make("Price")
                    ->label("Prijs")
                    ->placeholder('-')
                    ->numeric()
                    ->prefix('€')


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

    public static function table(Table $table): Table
    {
        return $table->recordTitleAttribute('name')
            ->groups([
                Group::make("project.location.name")->label("Locatie")->titlePrefixedWithLabel(false),
                Group::make("project.customer.name")->label("Relatie")->titlePrefixedWithLabel(false),
                Group::make("supplier.name")->label("Leverancier")->titlePrefixedWithLabel(false),

            ])
            ->columns([

                Tables\Columns\TextColumn::make("status.name")
                    ->label("Status")
                    ->badge()
                    ->placeholder('-')
                    ->sortable()->searchable(),


                Tables\Columns\TextColumn::make("number")->sortable()
                    ->label('Datum / nummer')->sortable()->searchable()
                    ->description(function (Quote $record) {
                        if (!$record?->request_date) {
                            return false;
                        } else {
                            return date("d-m-Y", strtotime($record?->request_date));
                        }
                    })->verticalAlignment(VerticalAlignment::Start)
                ,

                Tables\Columns\TextColumn::make("supplier.name")
                    ->label("")
                    ->getStateUsing(function (Quote $record): ?string {
                        if (!$record?->project?->customer_id) {
                            return false;
                        } else {
                            return $record?->project->customer->name . ' - ' . $record?->project->name;
                        }
                    })->wrap()
                    ->placeholder('-')
                    ->description(function (Quote $record) {
                        if (!$record?->company_id) {
                            return false;
                        } else {
                            return $record?->supplier?->name;
                        }
                    })
                ,


                Tables\Columns\TextColumn::make("price")
                    ->label("Prijs")
                    ->prefix('€')
                    ->placeholder('-')->sortable(),

                Tables\Columns\TextColumn::make("remembered_at")
                    ->label("Herinnering verstuurd")
                    ->dateTime("d-m-Y")
                    ->placeholder('-')->sortable(),

                Tables\Columns\TextColumn::make("accepted_at")
                    ->label("Accepteer datum ")
                    ->dateTime("d-m-Y")
                    ->placeholder('-')->sortable(),

                Tables\Columns\TextColumn::make("end_date")
                    ->label("Einddatum")
                    ->dateTime("d-m-Y")
                    ->placeholder('-')->sortable(),


                Tables\Columns\TextColumn::make("type_id")
                    ->label("Type")
                    ->badge()->sortable(),


            ])
            ->filters([
                SelectFilter::make("status_id")
                    ->label("Status")
                    ->relationship('status', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make("project_id")
                    ->label("Project")
                    ->relationship('project', 'name')
                    ->searchable()
                    ->preload(),


                SelectFilter::make("company_id")
                    ->label("Leverancier")
                    ->relationship('supplier', 'name')
                    ->searchable()
                    ->preload(),


            ])->filtersFormColumns(3)
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListQuotes::route('/'),
            'create' => Pages\CreateQuote::route('/create'),
            'edit' => Pages\EditQuote::route('/{record}/edit'),
        ];
    }
}
