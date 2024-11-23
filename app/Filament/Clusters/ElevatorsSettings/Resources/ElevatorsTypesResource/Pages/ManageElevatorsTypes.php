<?php

namespace App\Filament\Clusters\ElevatorsSettings\Resources\ElevatorsTypesResource\Pages;

use App\Filament\Clusters\ElevatorsSettings\Resources\ElevatorsTypesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;
use Filament\Actions\Action;
class ManageElevatorsTypes extends ManageRecords
{
    protected static string $resource = ElevatorsTypesResource::class;
    protected static ?string $title = 'Object - Types';

    protected function getHeaderActions(): array
    {
        return [

            Action::make('back')
            ->url(route('filament.admin.resources.objects.index'))
            ->label('Terug naar objecten')
            ->link()
            ->color('gray'),
            \EightyNine\ExcelImport\ExcelImportAction::make()->label('Importeren')
                ->color("primary"),
            Actions\CreateAction::make() ->icon('heroicon-m-plus') ->modalHeading('Toevoegen')->label('Toevoegen')->modalWidth(MaxWidth::ExtraLarge),
       ];
    }
}
