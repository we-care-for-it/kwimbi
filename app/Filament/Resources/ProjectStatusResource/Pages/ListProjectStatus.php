<?php
namespace App\Filament\Resources\ProjectStatusResource\Pages;

use App\Filament\Resources\ProjectStatusResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;

class ListProjectStatus extends ListRecords
{
    protected static string $resource = ProjectStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
                ->label('Terug naar instellingen')
                ->link()
                ->url(url()->previous())
                ->color('gray'),

            Actions\CreateAction::make()
                ->label('Toevoegen')
                ->modalWidth(MaxWidth::ExtraLarge)
                ->modalHeading('Project status  toevoegen'),

        ];
    }

    public function getHeading(): string
    {
        return "Project Statuses - Overzicht";
    }

    public function getTabs(): array
    {

        $relationTypes = relationType::whereIsActive(1)->orderBy('sort', 'asc')->get();

        $data_all = Relation::whereHas('type', function ($query) {
            $query->where('is_active', 1);
        });

        $tabs['Alles'] = Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $data_all)
            ->badge($data_all->count());

        foreach ($relationTypes as $relationType) {
            $tabs[$relationType->name] = Tab::make()
                ->ModifyQueryUsing(fn(Builder $query) => $query->where('type_id', $relationType->id))
                ->badge(Relation::query()->where('type_id', $relationType->id)->count());
        }

        return $tabs;
    }

}
