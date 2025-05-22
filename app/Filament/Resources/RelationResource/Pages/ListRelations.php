<?php
namespace App\Filament\Resources\RelationResource\Pages;

use App\Filament\Resources\RelationResource;
use App\Models\relationType;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Database\Eloquent\Builder;
use Relaticle\CustomFields\Filament\Tables\Concerns\InteractsWithCustomFields;

class ListRelations extends ListRecords
{
    use InteractsWithCustomFields;
    protected static string $resource = RelationResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth(MaxWidth::FourExtraLarge)
                ->modalHeading('Relatie toevoegen')
                ->modalDescription('Voeg een nieuwe relatie toe door de onderstaande gegeven zo volledig mogelijk in te vullen.')
                ->icon('heroicon-m-plus')
                ->modalIcon('heroicon-o-plus')
                ->slideOver()
                ->label('Relatie toevoegen'),
        ];
    }
    public function getHeading(): string
    {
        return "Relatie - Overzicht";
    }

    public function getTabs(): array
    {

        $relationTypes = relationType::get();

        foreach ($relationTypes as $relationType) {
            $tabs[$relationType->name] = Tab::make()
                ->ModifyQueryUsing(fn(Builder $query) => $query->where('type_id', $relationType->id));
        }

        return $tabs;
    }

}
