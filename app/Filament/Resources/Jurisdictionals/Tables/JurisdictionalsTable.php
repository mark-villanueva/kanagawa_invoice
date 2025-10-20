<?php

namespace App\Filament\Resources\Jurisdictionals\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class JurisdictionalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jurisdictional_office_code')
                    ->label('管轄事務所コード')
                    ->searchable(),
                TextColumn::make('jurisdictional_office_name')
                    ->label('管轄事務所')
                    ->searchable(),
                TextColumn::make('abbreviation')
                    ->label('略称')
                    ->searchable(),
                TextColumn::make('prefecture_city')
                    ->label('県市部') 
                    ->searchable()
                    ->getStateUsing(function ($record) {
                        $labels = [
                            'yokohama' => '横浜市',
                            'kawasaki' => '川崎市',
                            'yokosuka' => '横須賀市',
                            'sagamihara' => '相模原市',
                            'other' => '県市部',
                            'none' => '県外',
                        ];
                        return $labels[$record->prefecture_city] ?? $record->prefecture_city;
                    }),
                TextColumn::make('business_id')
                    ->label('事業者コード')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
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
