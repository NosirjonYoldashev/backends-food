<?php

namespace App\Enums;

use RuntimeException;

enum InvoiceEnum: string
{
    case DRAFT = 'draft';
    case CONFIRMED = 'confirmed';
    case REJECTED = 'rejected';

    public function translate(): string
    {
        return match ($this) {
            self::DRAFT => 'Черновик',
            self::CONFIRMED => 'Подтвержден',
            self::REJECTED => 'Отклонен',
            default => throw new RuntimeException('Kutilmagan holat: ' . $this->value)
        };
    }
}
