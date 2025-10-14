<?php

namespace App\Filament\Resources\Businesses\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BusinessesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('事業者コード'),
                TextColumn::make('facility')
                    ->label('施設名'),
                TextColumn::make('transfer_or_code')
                    ->label('振込先・コード')
                    ->getStateUsing(function ($record) {
                        if ($record->registration_category === 'account_information') {
                            $parts = array_filter([
                                $record->financial_institution,
                                $record->branch_name,
                            ]);
                            return implode(', ', $parts);
                        }

                        if ($record->registration_category === 'code') {
                            $labels = [
                                'number_code' => '債権者コード',
                                'registration_number' => '登録番号',
                            ];
                            return $labels[$record->code_type] ?? $record->code_type;
                        }

                        return null;
                    }),
                TextColumn::make('regNum_or_code')
                    ->label('')
                    ->getStateUsing(function ($record) {
                        if ($record->registration_category === 'code') {
                            if ($record->code_type === 'registration_number') {
                                return $record->registration_number;
                            }
                            return $record->number_code;
                        }

                        return null;
                    }),
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
