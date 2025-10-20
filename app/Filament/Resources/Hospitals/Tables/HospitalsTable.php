<?php

namespace App\Filament\Resources\Hospitals\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class HospitalsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('病院コード')
                    ->searchable(),
                TextColumn::make('hospital_name')
                    ->label('病院名')
                    ->searchable(),
                TextColumn::make('abbreviation')
                    ->label('略称')
                    ->searchable(),
                TextColumn::make('hospital_category')
                    ->label('病院区分')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'general_hospital' => '総合病院',
                        'clinic' => '診療所',
                        'rehabilitation_hospital' => 'リハビリテーション病院',
                        'specialist_hospital' => '専門病院',
                    }),
                TagsColumn::make('supporting_medical_departments')
                    ->label('対応診療科目')
                    ->separator(',')
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
