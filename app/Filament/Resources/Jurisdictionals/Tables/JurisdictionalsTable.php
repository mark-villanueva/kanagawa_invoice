<?php

namespace App\Filament\Resources\Jurisdictionals\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
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
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'yokohama_city' => '横浜市',
                            'kawasaki_city' => '川崎市',
                            'yokosuka_city' => '横須賀市',
                            'sagamihara_city' => '相模原市',
                            'other_cities' => '県内市部',
                            'outside_the_prefecture' => '県外',
                        };
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
