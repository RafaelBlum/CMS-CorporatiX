<?php


namespace App\Enums;


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
}
