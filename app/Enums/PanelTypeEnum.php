<?php

namespace App\Enums;

use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
/**
 * Enum create for especification type users in seeders, factories and method canAccessPanel User model
 */
enum PanelTypeEnum: string implements HasLabel, HasColor, HasIcon
{
    case ADMIN  =   "admin";
    case APP    =   "app";



    public function getLabel(): ?string
    {
        return match ($this) {
            self::ADMIN => 'Administrador',
            self::APP   => 'Usuário',
        };
    }


    public function getColor(): string | array | null
    {
        return match ($this) {
            self::ADMIN => 'success',
            self::APP   => 'warning',
        };
    }

    public function getIcon(): ?string
    {
           return match($this)
           {
                self::ADMIN => 'heroicon-o-shield-check',
                self::APP   => 'heroicon-o-users',
           };
    }
}
