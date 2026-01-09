<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Enum\ProductStatusEnum;
use App\Filament\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('Invoice ID'),
                    // ->url(fn (Order $record): string => OrderResource::getUrl('order', ['record' => $record])),
                TextColumn::make('customer.name')
                    ->sortable()
                    ->searchable(isIndividual: true, isGlobal: false),
                TextColumn::make('status')
                    ->badge(),                
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
