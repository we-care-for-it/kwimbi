<?php

namespace App\Filament\Widgets;

use App\Models\ObjectIncident;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Support\Enums\Alignment;
class LastIncidents extends BaseWidget
{
 
    protected static ?int $sort = 3;
    protected static ?string $heading = "Nieuwste storingen";

    protected int | string | array $columnSpan = '6';
    public function table(Table $table): Table
    {
        return $table
            ->query(ObjectIncident::limit(10))
            ->columns([
//                 Tables\Columns\TextColumn::make("id")
//                 ->label("#")
//                 ->getStateUsing(function ($record): ? string
//                 {
//                     return sprintf("%05d", $record ?->id);
//                 }) ,

//                 Tables\Columns\TextColumn::make("standing_still")
//                 ->label('')
//                 ->getStateUsing(function ($record): ? string
//                 {
//                     if($record->standing_still=="1"){
//                     return "Stilstand";
//                     }else{
//                      return   NULL;
//                     }
//                 }) 

//                 ->color('danger')
//                 ->badge()
//  ,

                Tables\Columns\TextColumn::make("report_date_time")
                    ->label("Gemeld op ")
                    ->sortable()
                    ->date('d-m-Y H:i')
                    ->wrap() ,

                Tables\Columns\TextColumn::make("description")
                    ->label("Omschrijving")
                    ->sortable()
                    ->wrap() ,

                Tables\Columns\TextColumn::make("status_id")
                    ->label("Status")
                    ->sortable()
                    ->badge() ,

                Tables\Columns\TextColumn::make("type_id")
                    ->label("Type")
                    ->badge(),
            ])
            ->recordUrl(function (ObjectIncident $record) {
                return "admin/objects/" .
                    $record->elevator_id .
                    "?activeRelationManager=1";
            })
            ->paginated(false);
    }
}
