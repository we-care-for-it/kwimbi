<?php

namespace App\Filament\Resources\ObjectLocationResource\RelationManagers;

use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectsRelationManager extends RelationManager
{
    protected static string $relationship = 'projects';
    protected static bool $isLazy = false;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }



    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->label('#')
                    ->getStateUsing(function (Project $record): ?string {
                        return sprintf('%05d', $record?->id);
                    })
                    ->searchable()->sortable()->description(function (Project $record) {

                        if (!$record?->description) {
                            return false;
                        } else {
                            return $record->description;
                        }


                    }),


                Tables\Columns\TextColumn::make('name')
                    ->label('Omschrijving')
                    ->searchable()->wrap(),




                Tables\Columns\TextColumn::make('startdate')
                    ->label('Looptijd')
                    ->getStateUsing(function (Project $record): ?string {


                        $startdate = $record->startdate ? date("d-m-Y", strtotime($record?->startdate)) : "nodate";
                        $enddate = $record->enddate ? date("d-m-Y", strtotime($record?->enddate)) : "nodate";

                        if ($record->enddate || $record->$startdate) {
                            return $startdate . " - " . $enddate;
                        } else {
                            return "";
                        }

                    })
                    ->searchable()->placeholder('Geen looptijd'),


//                Tables\Columns\TextColumn::make('description')
//                    ->label('Omschrijving')
//                    ->weight(FontWeight::Light)
//                    ->sortable()->wrap(),


                Tables\Columns\TextColumn::make('date_of_execution')
                    ->label('Plandatum')
                    ->getStateUsing(function (Project $record): ?string {


                        if ($record->date_of_execution) {
                            return date("d-m-Y", strtotime($record?->date_of_execution));
                        } else {
                            return "-";
                        }

                    })
                    ->searchable()
                    ->color(fn($record) => strtotime($record?->date_of_execution) < time() ? 'danger' : 'success')


                ,


//                Tables\Columns\TextColumn::make('cost_price')
//                    ->label('Winst')
//                    ->getStateUsing(function (Project $record): ?string {
//                        return $record?->quote_price - $record?->cost_price;
//                    })->prefix('€')
//                    ->color(fn($record) => $record?->quote_price - $record?->cost_price < 0 ? 'danger' : 'success')
//                    ->badge()->sortable()
//                    ->icon(fn($record) => $record?->quote_price - $record?->cost_price < 0 ? 'heroicon-m-exclamation-triangle' : false),


//                Tables\Columns\TextColumn::make('budget_costs')
//                    ->label('Over')
//                    ->getStateUsing(function (Project $record): ?string {
//                        $total_price = $record?->budget_costs - ($record?->quote_price - $record?->cost_price);
//                        return $total_price;
//                    })->prefix('€'),


                Tables\Columns\TextColumn::make('status.name')
                    ->label('Status')->sortable()
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
               // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Open project')->url(function (Project $record){
                    return "/admin/projects/".$record->id."/edit";

                })->icon('heroicon-c-link')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
