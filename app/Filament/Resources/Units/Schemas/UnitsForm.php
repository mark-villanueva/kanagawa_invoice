<?php

namespace App\Filament\Resources\Units\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class UnitsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('単価登録')
                    ->schema([
                        Grid::make(8)
                            ->schema([
                                DatePicker::make('start_date')
                                    ->label('開始日')
                                    ->timezone('Asia/Tokyo')
                                    ->native(false)
                                    ->displayFormat('Y F')
                                    ->locale('ja')
                                    ->required(),
                                
                                DatePicker::make('end_date')
                                    ->label('終了日')
                                    ->timezone('Asia/Tokyo')
                                    ->native(false)
                                    ->displayFormat('Y F')
                                    ->locale('ja')
                                    ->required(),
                                
                                Select::make('fee_name')
                                    ->label('名目')
                                    ->required()
                                    ->options([
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
                                    ]),
                                
                                TextInput::make('scheduled_amount')
                                    ->label('予定額')
                                    ->numeric()
                                    ->required(),
                                
                                TextInput::make('actual_amount')
                                    ->label('実績額')
                                    ->numeric(),
                                
                                TextInput::make('welfare_hospital_id')
                                    ->label('対象福祉・病院')
                                    ->required(),
                                
                                TextInput::make('difference')
                                    ->label('差分')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled(),
                                
                                Select::make('billing_status')
                                    ->label('処理ステータス')
                                    ->required()
                                    ->options([
                                        'unbilled' => '未請求',
                                        'done' => '完了',
                                    ])
                                    ->default('unbilled')
                                ]),
                        
                        Grid::make(4)
                            ->schema([
                                DatePicker::make('billing_date')
                                    ->label('請求日')
                                    ->timezone('Asia/Tokyo')
                                    ->native(false)
                                    ->displayFormat('Y F')
                                    ->locale('ja')

                            ]),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
