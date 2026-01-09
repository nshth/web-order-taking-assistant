<?php

namespace App\Enum;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OrderStatusEnum: string implements HasLabel, HasColor
{
    case PENDING = 'Pending';
    case CONFIRMED = 'Confirmed';
    case RECEIVED = 'Received';
    case RETURNED = 'Returned';

    public function getLabel(): string
    {
        return $this->value;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::CONFIRMED => 'success',
            self::RECEIVED => 'info',
            self::RETURNED => 'danger',
        };
    }
}