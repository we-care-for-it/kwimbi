<?php
namespace App\Filament\Resources\ToolsResource\Pages;

use App\Filament\Resources\ToolsResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\MaxWidth;

class ListTools extends ListRecords
{
    protected static string $resource = ToolsResource::class;
    protected static ?string $title   = 'Gereedschap - Overzicht';
    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit')
                ->icon('heroicon-o-cog-6-tooth')
                ->color('gray')
                ->label('Instellingen')
                ->link()
                ->url(route('filament.app.tools-settings')),

            Actions\CreateAction::make()->icon('heroicon-m-plus')->label('Toevoegen')->modalWidth(MaxWidth::SevenExtraLarge),

        ];
    }
}
