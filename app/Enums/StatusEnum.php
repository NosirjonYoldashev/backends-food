<?php

namespace App\Enums;

enum StatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public function translate(): string
    {
        return match ($this){
            self::INACTIVE => 'Неактивный',
            self::ACTIVE => 'Активный'
        };
     }
}
