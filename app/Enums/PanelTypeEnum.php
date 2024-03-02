<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
/**
 * Enum create for especification type users in seeders, factories and method canAccessPanel User model
 */
enum PanelTypeEnum: string implements HasLabel, HasColor
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
}
