<?php

namespace App\Filament\Resources\ObjectResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Illuminate\Http\Response;
use Filament\Support\Enums\MaxWidth;
use App\Models\ObjectInspection;
use App\Enums\InspectionStatus;
use Filament\Forms\Components\Grid;

use App\Models\ObjectInspectionCompany;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;

class InspectionsRelationManager extends RelationManager
{
    protected static string $relationship = "inspections";
    protected static ?string $title = "Keuringen";
    protected static bool $isLazy = false;
    
    public static function getBadge($ownerRecord, string $pageClass): ?string
    {
        return $ownerRecord->inspections->count();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            DatePicker::make("executed_datetime")
                ->label("Uitvoerdatum")
                ->required(),

            DatePicker::make("end_date")
                ->label("Einddatum")
                ->required(),

            Select::make("status_id")
                ->label("Status")
                ->required()
                ->options(InspectionStatus::class),

            Select::make("type")
                ->label("Type keuring")
                ->required()
                ->options([
                    "Periodieke keuring" => "Periodieke keuring",
                    "Modernisering keuring" => "Modernisering keuring",
                    "Opleveringskeuring" => "Oplever keuring",
                ]),

            Select::make("inspection_company_id")
                ->label("Keuringsinstantie")
                ->required()
                ->options(ObjectInspectionCompany::pluck("name", "id")),

            Grid::make(2)->schema([
                FileUpload::make("document")
                    ->columnSpan(1)
                    ->label("Rapportage"),

                Textarea::make("remark")
                    ->rows(7)
                    ->label("Opmerking")
                    ->columnSpan(1)
                    ->autosize(),
            ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table

            ->recordTitleAttribute("name")
            ->columns([
                Tables\Columns\TextColumn::make("status_id")
                    ->label("Resultaat")
                    ->badge()
                    ->sortable(),

                // Tables\Columns\TextColumn::make("if_match")

                // ->label("Bron")
                // ->getStateUsing(function ($record): ?string {

                //     if ($record->if_match) {
                //         return "Koppeling";
                //     } else {
                //         return "sdf";
                //     }  })->badge()

                Tables\Columns\TextColumn::make("inspectioncompany.name")
                    ->label("Instantie")
                    ->sortable()
                    ->description(fn($record) => $record->remark)
                    ->wrap(),

                Tables\Columns\TextColumn::make("executed_datetime")
                    ->dateTime("d-m-Y")
                    ->label("Uitgevoerd op")
                    ->sortable(),

                Tables\Columns\TextColumn::make("end_date")
                    ->dateTime("d-m-Y")
                    ->label("Geldig tot")
                    ->sortable(),

                Tables\Columns\TextColumn::make("type")
                    ->label("Type keuring")
                    ->sortable(),
            ])
            ->paginated(false)
            ->emptyState(view('partials.empty-state-small'))
            ->defaultSort('executed_datetime', 'desc')
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\Action::make("DownloadCertificate")
                //     ->label("Download certificaat")
                //     ->icon("heroicon-o-document-arrow-down")
                //     ->fillForm(
                //         fn($record): array => [
                //             "filename" =>
                //                 $record->status_id->getlabel() .
                //                 " - Certificate - " .
                //                 $record?->elevator?->location?->address .
                //                 ", " .
                //                 $record?->elevator?->location?->place,
                //         ]
                //     )
                //     ->action(function ($data, $record) {
                //         $contents = base64_decode($record->certification);
                //         $path = public_path($data["filename"] . ".pdf");

                //         file_put_contents($path, $contents);

                //         return response()
                //             ->download($path)
                //             ->deleteFileAfterSend(true);
                //     })
                //     ->modalWidth(MaxWidth::Large)
                //     ->modalHeading("Bestand downlaoden")
                //     ->modalDescription(
                //         "Geef een bestandsnaam om om het bestand te downloaden"
                //     )

                //     ->form([
                //         TextInput::make("filename")
                //             ->label("Bestandsnaam")
                //             ->required(),
                //     ])
                //     ->visible(fn($record) => $record?->certification ?? true),

                Tables\Actions\CreateAction::make()->label("Keuring toevoegen")->modalHeading("Keuring toevoegen")
                  ->modalDescription("Geef alle gegevens op van de keuring om te keuring opteslaan in de database")
            ])

            ->actions([
                Tables\Actions\Action::make("DownloadDocument")
                    ->label("Rapportage")
                    ->icon("heroicon-o-document-arrow-down")
                    ->fillForm(
                        fn($record): array => [
                            "filename" =>
                                $record->status_id->getlabel() .
                                " - Rapportage - " .
                                $record?->elevator?->location?->address .
                                ", " .
                                $record?->elevator?->location?->place,
                        ]
                    )
                    ->action(function ($data, $record) {
                        $contents = base64_decode($record->document);
                        $path = public_path($data["filename"] . ".pdf");

                        file_put_contents($path, $contents);

                        return response()
                            ->download($path)
                            ->deleteFileAfterSend(true);
                    })
                    ->modalWidth(MaxWidth::Large)
                    ->modalHeading("Bestand downloaden")
                    ->modalDescription(
                        "Geef een bestandsnaam om om het bestand te downloaden"
                    )

                    ->form([
                        TextInput::make("filename")
                            ->label("Bestandsnaam")
                            ->required(),
                    ])
                    ->visible(fn($record) => $record->document),

         

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->modalHeading("Keuring wijzigen")
                        ->url(function ($record) {
                            return "/admin/object-inspections/" . $record->id . "/edit";
                        })->modalDescription(function ($record): ?string {
                            if ($record->if_match) {
                                return "Let op! Deze keuring is geimporteerd vanuit de koppeling met de keuringsinstantie.";
                            } else {
                                return "";
                            }
                        }) 

                        ,Tables\Actions\Action::make('seeDetails')
                        ->label('Toon details')->color('success')->icon('heroicon-m-eye')
                        ->url(function ($record) {
                            return "/admin/object-inspections/" .
                                $record->id ;
                        }),

                        
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])

            ->recordUrl(function ($record) {
                return "/admin/object-inspections/" . $record->id;
            })
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //      Tables\Actions\DeleteBulkAction::make(),
                ])->label('Toevoegen'),
            ]);
    }
}
