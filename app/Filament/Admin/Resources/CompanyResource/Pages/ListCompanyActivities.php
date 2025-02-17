<?php
 
namespace App\Filament\Admin\Resources\CompanyResource\Pages;
 
use pxlrbt\FilamentActivityLog\Pages\ListActivities;
use App\Filament\Admin\Resources\CompanyResource;
use Filament\Actions;
use Filament\Admin\Resources\Pages\ListRecords;

class ListCompanyActivities extends ListActivities
{
    protected static string $resource = CompanyResource::class;
}