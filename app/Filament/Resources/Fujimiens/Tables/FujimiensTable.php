<?php

namespace App\Filament\Resources\Fujimiens\Tables;

use App\Models\Fujimien;
use App\Models\Histories;
use App\Models\Jurisdictionals;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class FujimiensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('利用者コード')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('氏名')
                    ->searchable(),
                TextColumn::make('name_kana')
                    ->label('氏名(カナ)')
                    ->searchable(),
                TextColumn::make('current_age')
                    ->label('年齢')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('gender')
                    ->label('性別')
                    ->searchable(),
                TextColumn::make('town')    
                    ->label('町名')
                    ->searchable(),
                TextColumn::make('jurisdictionals.jurisdictional_office_name')
                    ->label('管轄事務所')
                    ->searchable(),
                TextColumn::make('histories.status')
                    ->label('ステータス')
                    ->searchable(),
                TextColumn::make('histories.admission_date')
                    ->label('入所日')
                    ->date()
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
