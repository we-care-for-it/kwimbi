<?php

namespace App\Filament\Clusters\ToolsSettings\Resources\ToolsInspectionCompaniesResource\Pages;

use App\Filament\Clusters\ToolsSettings\Resources\ToolsInspectionCompaniesResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Actions\Action;
class ManageToolsInspectionCompanies extends ManageRecords
{
    protected static ?string $title = 'Gereedschap - Keuringsinstanties';

    protected static string $resource = ToolsInspectionCompaniesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('back')
            ->url(route('filament.admin.resources.tools.index'))
            ->label('Terug naar gereedschappen') 
            ->link()
            ->color('gray'),
            Actions\CreateAction::make()->label('Toevoegen')->modalHeading('Toevoegen'),
        ];
    }
}
