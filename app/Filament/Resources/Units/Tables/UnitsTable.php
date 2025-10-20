<?php

namespace App\Filament\Resources\Units\Tables;

use App\Traits\FormatsJapaneseEra;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class UnitsTable
{
    use FormatsJapaneseEra;
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('start_date')
                    ->label('開始日')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => (new self())->formatJapaneseEraForDisplay($state)),
                TextColumn::make('end_date')
                    ->label('終了日')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => (new self())->formatJapaneseEraForDisplay($state)),
                TextColumn::make('fee_name')
                    ->label('名目')
                    ->searchable(),
                TextColumn::make('scheduled_amount')
                    ->label('予定額')
                    ->numeric(),
                TextColumn::make('actual_amount')
                    ->label('実績額')
                    ->numeric(),
                TextColumn::make('welfare_hospital')
                    ->label('対象先')
                    ->numeric(),
                TextColumn::make('difference')
                    ->label('差額')
                    ->numeric(),
                TextColumn::make('billing_status')
                    ->label('請求ステータス')
                    ->searchable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
