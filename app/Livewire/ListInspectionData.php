<?php

namespace App\Livewire;

use App\Models\ObjectInspection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Livewire\Component;


class ListInspectionData   extends Component implements HasForms, HasTable
{

    use InteractsWithTable;
    use InteractsWithForms;


    public ObjectInspection $category;




    public function table(Table $table): Table
    {
        return $table

            ->relationship(fn (): BelongsToMany => $this->category->itemdata())
            ->inverseRelationship('itemdata')



            ->query(ObjectInspection::query())
            ->columns([
                TextColumn::make('name'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
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
