<?php
namespace App\Filament\Pages;

use App\Models\GeneralSetting;
use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view                   = 'filament.pages.settings';
    protected static ?string $navigationLabel       = "Instellingen";
    protected static ?string $modelLabel            = 'Instellingen';
    protected static ?string $pluralModelLabel      = 'Instellingen';
    protected static ?string $title                 = "Instellingen";
    protected static bool $shouldRegisterNavigation = false;
    protected static ?int $navigationSort           = 99;

    public ?string $keyword = '';
    public $results         = [];

    public function mount()
    {
        $this->results = GeneralSetting::all();
    }
    public function updatedQuery($value)
    {
        $this->search();
    }

    public function search()
    {

        $this->results = GeneralSetting::where('name', 'like', '%' . $this->keyword . '%')
            ->get();

    }
}
