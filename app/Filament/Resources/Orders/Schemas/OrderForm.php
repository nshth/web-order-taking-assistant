<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('total')
                    ->required(),
                TextInput::make('customer_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
