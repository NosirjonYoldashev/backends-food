<?php

namespace App\Enums;

enum MovementProductType: string
{

    case ARRIVAL = 'arrival';
    case DEPARTURE = 'departure';
    case TRANSFER = 'transfer';

    case RETURN = 'return';

    public function translate(): string
    {
        return match($this) {
            self::ARRIVAL =>'Приход',
            self::DEPARTURE => 'Выход',
            self::TRANSFER => 'Перемещение',
            self::RETURN => 'Возврат',
        };
    }
}
