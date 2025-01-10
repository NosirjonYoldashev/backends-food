<?php

namespace App\Enums;

enum MovementCashType: string
{

    case POSITIVE = 'positive';
    case NEGATIVE = 'negative';
    case CLEAR = 'clear';

    public function translate(): string
    {
        return match($this) {
            self::POSITIVE => 'Приход',
            self::NEGATIVE => 'Расход',
            self::CLEAR => 'Инкассация',
        };
    }
}
