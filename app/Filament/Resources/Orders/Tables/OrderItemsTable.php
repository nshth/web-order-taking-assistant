<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable(),
                    
                TextColumn::make('quantity')
                    ->numeric(),
                    
                TextColumn::make('price')
                    ->money('USD'),
                    
                TextColumn::make('line_total')
                    ->label('Subtotal')
                    ->getStateUsing(fn ($record) => $record->price * $record->quantity)
                    ->money('USD'),
            ]);
    }
}