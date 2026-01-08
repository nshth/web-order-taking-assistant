<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ModalTableSelect;
use Filament\Tables\Columns\ToggleColumn;

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
                TextInput::make('description')
                    ->required()
                    ->maxLength(100),
                // ModalTableSelect::make('category_id')
                //     ->relationship('category', 'name')
                //     ->tableConfiguration(CategoriesTable::class)
            ]);
    }
}
