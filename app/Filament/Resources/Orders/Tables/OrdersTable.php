<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Enum\ProductStatusEnum;
use App\Filament\Resources\Customers\CustomerResource;
use App\Filament\Resources\Orders\OrderResource;
use App\Models\Order;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                    ->searchable(isIndividual: true, isGlobal: false)
                    ->url(fn (Order $record): string => 
                        CustomerResource::getUrl('view', [
                            'record' => $record
                        ])),
                TextColumn::make('total')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge(),
                    
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('M d, Y')
                    ->sortable(),

            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'Pending' => 'Pending',
                        'Confirmed' => 'Confirmed',
                        'Received' => 'Received',
                        'Returned' => 'Returned',
                    ]),
            ])

            ->defaultSort('created_at', 'desc')
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
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
