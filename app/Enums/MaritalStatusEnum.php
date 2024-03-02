<?php


namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum MaritalStatusEnum: string implements HasLabel, HasColor
{
    case SINGLE         = 'single';
    case MARRIED        = 'married';
    case DO_NOT_DEFINE  = 'do-not-define';

    public function getLabel(): string
    {
        return match ($this)
        {
            self::SINGLE        => 'solteiro',
            self::MARRIED       => 'casado(a)',
            self::DO_NOT_DEFINE => 'prefere não definir',
        };
    }

    public function getColor(): string | array | null
    {
        return match ($this)
        {
            self::SINGLE        => 'success',
            self::MARRIED       => 'danger',
            self::DO_NOT_DEFINE => 'warning',
        };
    }

}
