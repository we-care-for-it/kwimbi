<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view                   = 'filament.pages.settings';
    protected static ?string $navigationLabel       = "Stamgegevens";
    protected static ?string $modelLabel            = 'Stamgegevens';
    protected static ?string $pluralModelLabel      = 'Stamgegevens';
    protected static ?string $title                 = "Stamgegevens";
    protected static bool $shouldRegisterNavigation = false;

    protected static ?int $navigationSort = 99;
    //protected static ?string $navigationGroup = 'Beheer';
}
