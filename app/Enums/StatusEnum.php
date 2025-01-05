<?php

namespace App\Enums;

enum StatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    case DRAFT = 'draft';

    case APPROVED = 'approved';

    case REJECTED = 'rejected';

    case ADDITION = 'addition';

    case SUBTRACTION = 'subtraction';
    public function translate(): string
    {
        return match ($this){
            self::INACTIVE => 'Неактивный',
            self::ACTIVE => 'Активный'
        };
     }


    public function IngredientInvoiceStatus(): string
    {
        return match ($this){
            self::DRAFT => 'draft',
            self::APPROVED => 'approved',
            self::REJECTED => 'rejected',
        };
    }

    public function StockMovementType(): string
    {
        return match ($this){
            self::ADDITION => 'addition',
            self::SUBTRACTION => 'subtraction',
        };
    }
}
