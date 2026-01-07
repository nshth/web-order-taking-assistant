<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ModalTableSelect;
use App\Enum\ProductStatusEnum;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->unique(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    // ->prefix('$')
                    ->rule('numeric'),
                TextInput::make('stock')
                    ->required()
                    ->numeric(),
                // Radio::make('status')
                //     ->options(ProductStatusEnum::class)
                //     ->required(),
                // ModalTableSelect::make('category_id')
                //     ->relationship('category', 'name')
                //     ->tableConfiguration(CategoriesTable::class)
            ]);
    }
}
