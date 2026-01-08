<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use App\Enum\ProductStatusEnum;
use App\Filament\Resources\Products\ProductResource;
use App\Models\Product;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\SelectColumn;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    // ->url(fn (Product $record): string => ProductResource::getUrl('view', ['record' => $record]))
                    ->sortable()
                    ->searchable(isIndividual: true, isGlobal: false),
                TextColumn::make('price')
                    ->money('LKR', 100)
                    ->sortable(),
                ToggleColumn::make('is_active'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (ProductStatusEnum $state): string => match ($state) {
                        ProductStatusEnum::IN_STOCK => 'success',
                        ProductStatusEnum::LOW_STOCK => 'warning',
                        ProductStatusEnum::SOLD_OUT => 'danger',
                    }),
                TextColumn::make('created_at')
                    // ->dateTime('d-m-y H:i')
                    // ->date('Y-M-D')
                    ->since()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
