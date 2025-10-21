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
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'facility_costs' => '施設事務費', 
                            'standard_living_costs___basic_amount' => '基準生活費ー基本額', 
                            'standard_living_costs___winter_additional_allowance' => '基準生活費ー冬期加算', 
                            'standard_living_costs___term_end_temporary_assistance' => '基準生活費ー期末一時扶助', 
                            'daily_necessities_costs___daily_necessities_costs' => '日用品費ー日用品費', 
                            'daily_necessities_costs___winter_additional_allowance' => '日用品費ー冬期加算', 
                            'daily_necessities_costs___term_end_temporary_assistance' => '日用品費ー期末一時扶助',
                            'day_care_costs' => '通所事業事務費',
                            'temporary_admisison_costs' => '一時入所費',
                            'disability_allowances_grade_1' => '障害加算金　1級',
                            'disability_allowances_grade_2' => '障害加算金　2級',
                            'benefit' => '給付金'
                        };
                    }),
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
