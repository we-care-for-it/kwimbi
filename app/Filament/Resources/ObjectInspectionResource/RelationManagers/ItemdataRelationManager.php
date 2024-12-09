<?php

namespace App\Filament\Resources\ObjectInspectionResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\MaxWidth;

use Filament\Notifications\Notification;

//Form
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;

//Tables
use Filament\Tables;
use Filament\Tables\Table;

//Models
use App\Models\ObjectInspectionZincode;
use App\Models\ObjectInspectionData;

class ItemdataRelationManager extends RelationManager
{
    protected static string $relationship = "itemdata";
    protected static ?string $title = "Keuringspunten";

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    Forms\Components\TextInput::make("zin_code")
                    ->suffixAction(
                        Action::make("searchZinCode")
                            ->icon("heroicon-m-magnifying-glass")
                            ->action(function (Get $get, Set $set) {
                                $data = ObjectInspectionZincode::where(
                                    "code",
                                    $get("zin_code")
                                )
                                    ->select("description")
                                    ->get();

                                if (count($data) != 0) {
                                    $set("comment", $data[0]->description);
                                }else{
                                    Notification::make()
                                    ->title('Geen ZIN Code gevonden in de database')
                                    ->danger()
                                    ->send();
                                }
                            })
                    ),

                    Select::make("type")->options([
                        "Technisch"     => "Technisch",
                        "Arbotechnisch" => "Arbotechnisch",
                        "Bouwkundig"    => "Bouwkundig",
                    ]),
                    
                    Select::make("status")->options([
                        "Herhaling" => "Herhaling",
                        "Afkeur" => "Afkeur",
                    ]),

                ]),

                Grid::make(1)->schema([
                    TextArea::make("comment")->label(
                        "Omschrijving"
                    ),
                ]),
            ])
            ->columns(4);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute("name")
            ->columns([
                Tables\Columns\TextColumn::make("zin_code")->label("Code"),
                Tables\Columns\TextColumn::make("comment")
                ->label("Opmerking")
                ->wrap(),
                Tables\Columns\TextColumn::make("type")->label("Type"),
                Tables\Columns\TextColumn::make("status")
                    ->label("Status")
                    ->badge()
                    ->placeholder("-")
                    ->color("warning"),
            ])
         
            ->paginated(false)
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label("Toevoegen")
                //    ->hidden($this->getOwnerRecord()->schedule_run_token)
              
                        ->modalHeading("Keuringspunt toevoegen"),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->iconbutton()
                    ->modalHeading("Wijzig keuringspunt"),
                Tables\Actions\DeleteAction::make()->iconbutton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->emptyState(view('partials.empty-state-small')) ;
    }
}
