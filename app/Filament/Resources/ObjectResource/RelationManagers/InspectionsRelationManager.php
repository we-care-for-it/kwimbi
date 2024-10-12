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

class InspectionsRelationManager extends RelationManager
{
    protected static string $relationship = "inspections";
    protected static ? string $title = 'Keuringen';
  

    public static function getBadge($ownerRecord, string $pageClass) : ? string
    {
        return $ownerRecord
            ->inspections
            ->count();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make("name")
                ->required()
                ->maxLength(255),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("name")
            ->columns([
                Tables\Columns\TextColumn::make("executed_datetime")
                    ->dateTime("d-m-Y")
                    ->label("Uitgevoerd op"),

                Tables\Columns\TextColumn::make("end_date")
                    ->dateTime("d-m-Y")
                    ->label("Geldig tot"),

                Tables\Columns\TextColumn::make("inspectioncompany.name")
                    ->label("Instantie")

                    ->description(fn($record) => $record->remark),

                Tables\Columns\TextColumn::make("type")
                    ->label("Type keuring")
                    ->sortable(),

                Tables\Columns\TextColumn::make("status_id")
                    ->label("Resultaat")
                    ->badge()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
            Tables\Actions\CreateAction::make()])
            ->actions([
                Tables\Actions\Action::make("DownloadDocument")
                    ->label("Rapportage")
                    ->icon("heroicon-o-document-arrow-down")
                    ->fillForm(
                        fn($record): array => [
                            "filename" =>
                                $record->status_id->getlabel() .
                                " - Rapportage - ". 
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
                    ->modalHeading("Bestand downlaoden")
                    ->modalDescription(
                        "Geef een bestandsnaam om om het bestand te downloaden"
                    )

                    ->form([
                        TextInput::make("filename")
                            ->label("Bestandsnaam")
                            ->required(),
                    ])
                    ->visible(fn($record) => $record->document),

                    Tables\Actions\CreateAction::make()])
                    ->actions([
                        Tables\Actions\Action::make("DownloadCertificate")
                            ->label("Certificaat")
                            ->icon("heroicon-o-document-arrow-down")
                            ->fillForm(
                                fn($record): array => [
                                    "filename" =>
                                        $record->status_id->getlabel() .
                                        " - Certificate - ". 
                                        $record?->elevator?->location?->address .
                                        ", " .
                                        $record?->elevator?->location?->place,
                                ]
                            )
                            ->action(function ($data, $record) {
                                $contents = base64_decode($record->certification);
                                $path = public_path($data["filename"] . ".pdf");
        
                                file_put_contents($path, $contents);
        
                                return response()
                                    ->download($path)
                                    ->deleteFileAfterSend(true);
                            })
                            ->modalWidth(MaxWidth::Large)
                            ->modalHeading("Bestand downlaoden")
                            ->modalDescription(
                                "Geef een bestandsnaam om om het bestand te downloaden"
                            )
        
                            ->form([
                                TextInput::make("filename")
                                    ->label("Bestandsnaam")
                                    ->required(),
                            ])
                            ->visible(fn($record) => $record->certification),
        

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
