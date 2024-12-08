<?php

namespace App\Livewire;

use App\Models\ObjectInspection;
use App\Models\ObjectInspectionData;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
 
use Livewire\Component;

use Illuminate\Http\Request;

class ListInspectionData   extends Component implements HasForms, HasTable
{

    use InteractsWithTable;
    use InteractsWithForms;
 
    public $inpection_id;

    public function mount(): void 
    {
        $this->inpection_id =$inpection_id;
    }


    public function table(Table $table): Table
    {
        return $table


         ->query(ObjectInspectionData::where('inspection_id', $this->inpection_id))
            ->columns([
                TextColumn::make("status_id")

                    ->label("Einddatum")
                    ->sortable(),

 TextColumn::make("zin_code")

                    ->label("Einddatum")
                    ->sortable(),



            ])
            ->filters([
                // ...
            ])
            ->actions([
              
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function render()
    {
        return view('livewire.list-inspection-data');
    }

}
