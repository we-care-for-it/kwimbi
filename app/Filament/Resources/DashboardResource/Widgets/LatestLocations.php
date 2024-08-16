<?php

namespace App\Filament\Resources\DashboardResource\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\objectLocation;


use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
//Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ImageColumn;



class LatestLocations extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                objectLocation::limit(5)
            )
            ->columns([
                ImageColumn::make('image')
                ->label('')
                ->width(100),
    
           
 
                            Tables\Columns\TextColumn::make('address')
                
                        
                            ->weight('medium')
                            ->alignLeft(),
     
    
    
                            Tables\Columns\TextColumn::make('zipcode')
                  
                        
                            ->weight('medium')
                            ->alignLeft(),
     
    
    
                            Tables\Columns\TextColumn::make('place')
      
                        
                            ->weight('medium')
                            ->alignLeft(),
     
    
                 
    
                    Tables\Columns\TextColumn::make('objectbuildingtype.name')
                    ->label('Type')
    
            ]);
    }
}
