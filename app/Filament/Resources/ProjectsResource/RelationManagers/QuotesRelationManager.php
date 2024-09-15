<?php

namespace App\Filament\Resources\ProjectsResource\RelationManagers;

use App\Models\Customer;
use App\Models\ObjectLocation;
use App\Models\ObjectMaintenanceCompany;
use App\Models\Project;
use App\Models\Statuses;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class QuotesRelationManager extends RelationManager
{
    protected static string $relationship = 'quotes';
    protected static ?string $title = 'Offertes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([



                        Select::make("type_id")
                            ->label("Type")
                            ->required()
                            ->reactive()
                            ->options([
                                '1' => 'Eigen offerte ',
                                '2' => 'Exteren leveranier'
                            ]
                            )->columnSpan("full")
                            ->default('1'),

                        Select::make("company_id")

                            ->label("Extern leverancier")
                            ->default('1')
//                            ->columnSpan("full")
//                            ->disabled(function (Quote $record) {
//                                if (!$record?->type_id) {
//                                    return false;
//                                } else {
//                                    return true;
//                                }
//                            })

                            ->options(
                                ObjectMaintenanceCompany::all()->pluck("name", "id")
                            ),


                        TextInput::make("number")
                            ->label("Nummer"),

                        TextInput::make("Price")

                            ->label("Prijs"),








                    ])
                    ->columns(2)
                    ->columnSpan(1),

                Section::make()
                    ->schema([


          DatePicker::make("request_date")->label("Aanvraagdatum"),

                DatePicker::make("remembered_at")->label(
                    "Herindering op"),

                      DatePicker::make("accepted_at")->label(
                          "Geaccpteerd op"),

                            DatePicker::make("end_date")->label(
                                "Einddatum"),


                           Select::make("status_id")
                               ->label("Status")
                               ->required()
                               ->reactive()
                               ->options(
                                   Statuses::where(
                                       "model",
                                       "ProjectQuotes"
                                   )->pluck("name", "id")
                               )->columnSpan("full"),


                    ])
                    ->columns(2)
                    ->columnSpan(1),


                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make("remark")
                            ->label("Opmerking")
                            ->maxLength(255)

                            ->columnSpan("full"),

                    ])
                    ->columns(2)
                    ->columnSpan(2),

                Section::make()
                    ->schema([
                        FileUpload::make('attachment')
                            ->columnSpan(3)
                            ->preserveFilenames()

                            ->visibility('private')
                            ->directory(function () {
                                $parent_id = $this->getOwnerRecord()->id;
                                return '/uploads/project/' . $parent_id . '/quotes';
                            })
                    ])

                    ->columns(2)
                    ->columnSpan(2),


            ]);




    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make("request_date")
                    ->dateTime("d-m-Y")
                    ->label("Offertedatum"),
                Tables\Columns\TextColumn::make("number")->label('Nummer'),

                Tables\Columns\TextColumn::make("status.name")
                    ->label("Status")
                    ->badge(),

                        Tables\Columns\TextColumn::make("price")
                            ->label("Prijs"),


                Tables\Columns\TextColumn::make("remembered_at")
                    ->label("Herindering verstuurd")
                    ->dateTime("d-m-Y"),

                Tables\Columns\TextColumn::make("accepted_at")
                    ->label("Accepteer datum ")
                    ->dateTime("d-m-Y"),


                Tables\Columns\TextColumn::make("end_date")
                    ->label("Aanvraag einde")
                    ->dateTime("d-m-Y")
                ,







        ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()->label(''),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }
}
