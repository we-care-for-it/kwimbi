<?php

namespace App\Filament\Admin\Themes;

use Filament\Panel;
use Hasnayeen\Themes\Contracts\CanModifyPanelConfig;
use Hasnayeen\Themes\Contracts\Theme;

class LiftIndex implements CanModifyPanelConfig, Theme
{
    public static function getName(): string
    {
        return 'lift-index';
    }

    public static function getPath(): string
    {
        return 'resources/css/filament/admin/themes/lift-index.css';
    }

    public function getThemeColor(): array
    {
        return [
            'primary' => 'red',
        ];
    }

    public function modifyPanelConfig(Panel $panel): Panel
    {
        return $panel
            ->theme($this->getPath());
    }
}
