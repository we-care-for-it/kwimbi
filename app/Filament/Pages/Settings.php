<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view             = 'filament.pages.settings';
    protected static ?string $navigationLabel = "Beheer";
    protected static ?int $navigationSort     = 99;
    //protected static ?string $navigationGroup = 'Beheer';
}
