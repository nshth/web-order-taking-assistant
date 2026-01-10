<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use App\Filament\Resources\Customers\CustomerResource;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
// use Filament\Forms\Components\TextColumn;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\Summarizers\Summarizer;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'orderItems';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
            Select::make('product_id')
                ->relationship('product', 'name')
                ->required()
                ->searchable()
                ->preload(),

            TextInput::make('quantity')
                ->numeric()
                ->default(1)
                ->required()
                ->live() // Updates calculations in real-time if needed
                ->minValue(1),

            TextInput::make('price')
                ->numeric()
                ->prefix('$')
                ->required()
                ->helperText('Price per unit'),
        ]);
}

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product_id')
            ->columns([
                TextColumn::make('product.name')
                    ->label('Product')
                    ->sortable()
                    ->searchable(),
                    
                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),
                    
                TextColumn::make('price')
                    ->prefix('$')
                    ->sortable(),
                    
                // nested relationship
                TextColumn::make('order.customer.name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable()
                    ->url(fn ($record) =>
                        CustomerResource::getUrl('view', [
                            'record' => $record->order->customer,
                        ]),
                    ),
                    
                TextColumn::make('line_total')
                    ->label('Sub Total')
                    ->getStateUsing(fn ($record) => $record->price * $record->quantity)
                    ->money('USD')
                    ->summarize(
                        Summarizer::make()
                            ->label('Order Total')
                            ->using(fn ($query) => $query->get()->sum(fn ($record) => $record->price * $record->quantity))
                            ->money('USD')
                    ),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
