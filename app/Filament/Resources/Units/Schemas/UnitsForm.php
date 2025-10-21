<?php

namespace App\Filament\Resources\Units\Schemas;

use App\Models\Hospitals;
use App\Models\Jurisdictionals;
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
                        Grid::make(5)
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
                                    ->required()
                                    ->live()
                                    ->afterStateUpdated(function (callable $get, callable $set) {
                                        $scheduledAmount = (float) $get('scheduled_amount') ?? 0;
                                        $actualAmount = (float) $get('actual_amount') ?? 0;
                                        $difference = $actualAmount - $scheduledAmount;
                                        $set('difference', $difference);
                                    }),
                                
                                TextInput::make('actual_amount')
                                    ->label('実績額')
                                    ->numeric()
                                    ->live()
                                    ->afterStateUpdated(function (callable $get, callable $set) {
                                        $scheduledAmount = (float) $get('scheduled_amount') ?? 0;
                                        $actualAmount = (float) $get('actual_amount') ?? 0;
                                        $difference = $actualAmount - $scheduledAmount;
                                        $set('difference', $difference);
                                    }),

                                Select::make('welfare_hospital')
                                    ->label('対象福祉')
                                    ->options([
                                        '2' => '管轄事務所一覧', 
                                        '3' => '病院一覧', 
                                    ])
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->live()
                                    ->afterStateUpdated(function (callable $set) {
                                        $set('welfare_hospital_id', []);
                                    }),

                                Select::make('welfare_hospital_id')
                                    ->label('対象福祉・病院')
                                    ->required(fn (callable $get) => filled($get('welfare_hospital')))
                                    ->searchable()
                                    ->hidden(fn (callable $get) => !$get('welfare_hospital'))
                                    ->options(function (callable $get) {
                                        $welfareHospital = $get('welfare_hospital');
                                        
                                        if ($welfareHospital === '2') {
                                            // 管轄事務所一覧 - show jurisdictional office names
                                            return Jurisdictionals::query()->pluck('jurisdictional_office_name', 'jurisdictional_office_name');
                                        } elseif ($welfareHospital === '3') {
                                            // 病院一覧 - show hospital names
                                            return Hospitals::query()->pluck('hospital_name', 'hospital_name');
                                        }
                                        
                                        return [];
                                    })
                                    ->preload()
                                    ->multiple(),
                                
                                TextInput::make('difference')
                                    ->label('差分')
                                    ->numeric()
                                    ->default(0)
                                    ->readOnly(),
                                
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
