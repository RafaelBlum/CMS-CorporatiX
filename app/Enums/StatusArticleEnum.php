<?php


namespace App\Enums;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Contracts\HasColor;

enum StatusArticleEnum: string implements HasLabel, HasColor
{
    case DRAFT = 'DRAFT';
    case PUBLISHED = 'PUBLISHED';
    case PENDING_REVIEW = 'PENDING_REVIEW';
    case SCHEDULED = 'SCHEDULED';
    case PRIVATE = 'PRIVATE';

    public function getLabel(): string
    {
        return match ($this)
        {
            self::DRAFT => 'Rascunho',
            self::PUBLISHED => 'Publicar',
            self::PENDING_REVIEW => 'Pendente para analise',
            self::SCHEDULED => 'Programado',
            self::PRIVATE => 'Privado',
        };
    }

    public function getColor(): string | array | null
    {
           return match ($this)
           {
                self::DRAFT => 'warning',
                self::PUBLISHED => 'success',
                self::PENDING_REVIEW => 'warning',
                self::SCHEDULED => 'warning',
                self::PRIVATE => 'danger',
           };
    }
}
