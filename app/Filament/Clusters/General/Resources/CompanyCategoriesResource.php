<?php

namespace App\Filament\Clusters\General\Resources;

use App\Filament\Clusters\General;
use App\Filament\Clusters\General\Resources\CompanyCategoriesResource\Pages;
use App\Filament\Clusters\General\Resources\CompanyCategoriesResource\RelationManagers;

use App\Models\companyType;


use Filament\Resources\Resource;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Filament\Support\Enums\MaxWidth;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class CompanyCategoriesResource extends Resource
{
    protected static ?string $model = companyType::class;
    protected static ?string $navigationIcon = "heroicon-o-rectangle-stack";
    protected static ?string $cluster = General::class;
    protected static ?string $navigationGroup = "Basisgegevens";
    protected static ?string $navigationLabel = "Relatie categorieën";
  
    
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make("name")
                ->label("Naam")
                ->required()
                ->columnSpan("full"),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->searchable()
                    ->label("Naam")
                    ->description(function ($record): ?string {
                        if (
                            $record?->id == 1 ||
                            $record?->id == 2 ||
                            $record?->id == 3 ||
                            $record?->id == 4 ||
                            $record?->id == 5 ||
                            $record?->id == 6 ||
                            $record?->id == 7
                        ) {
                            return "Systeem standaard";
                        } else {
                            return false;
                        }
                    })
                    ->color(function ($record): ?string {
                        if (
                            $record?->id == 1 ||
                            $record?->id == 2 ||
                            $record?->id == 3 ||
                            $record?->id == 4 ||
                            $record?->id == 5 ||
                            $record?->id == 6 ||
                            $record?->id == 7
                        ) {
                            return "danger";
                        } else {
                            return "secondary";
                        }
                    }),

                TextColumn::make("companies_count")
                    ->label("Bedrijven")
                    ->counts("companies")
                    ->alignCenter()
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(function ($record): ?string {
                        if (
                       $record?->id == 1 ||
                            $record?->id == 2 ||
                            $record?->id == 3 ||
                            $record?->id == 4 ||
                            $record?->id == 5 ||
                            $record?->id == 6 ||
                            $record?->id == 7
                        ) {
                            return false;
                        } else {
                            return true;
                        }
                    })

                    ->label("Bewerken")
                    ->modalHeading("Bewerken")
                    ->modalWidth(MaxWidth::Large),

                    Tables\Actions\DeleteAction::make()
                    ->visible(function ($record): ?string {
                        if (
                       $record?->id == 1 ||
                            $record?->id == 2 ||
                            $record?->id == 3 ||
                            $record?->id == 4 ||
                            $record?->id == 5 ||
                            $record?->id == 6 ||
                            $record?->id == 7
                        ) {
                            return false;
                        } else {
                            return true;
                        }
                    })

                    ->label("")
                    ->modalHeading("Verwijderen")
                    ->modalWidth(MaxWidth::Large),


            ])
            ->bulkActions([
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
            "index" => Pages\ListCompanyCategories::route("/"),
        ];
    }
}
