<?php

namespace App\Enum;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProductStatusEnum: string implements HasLabel, HasColor
{
    case IN_STOCK = 'In Stock';
    case SOLD_OUT = 'Sold Out';
    case LOW_STOCK = 'Low Stock';

    public function getLabel(): string
    {
        return $this->value;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::IN_STOCK => 'success',
            self::SOLD_OUT => 'warning',
            self::LOW_STOCK => 'danger',
        };
    }
}