<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;
/**
 * Enum create for especification type users in seeders, factories and method canAccessPanel User model
 */
enum PanelTypeEnum: string
{
    case ADMIN  =   "admin";
    case USER    =   "user";

    public function getLabels(): string
    {
        return match ($this){
            self::ADMIN => 'admin',
            self::USER  => 'user'
        };
    }

//    public function getColor(): string | array | null
//    {
//        return match ($this) {
//            self::ADMIN => 'success',
//            self::USER => 'warning',
//        };
//    }
}
