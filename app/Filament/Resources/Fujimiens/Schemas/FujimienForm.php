<?php

namespace App\Filament\Resources\Fujimiens\Schemas;

use App\Models\Jurisdictionals;
use App\Models\Fujimien;
use App\Models\Histories;
use App\Models\Businesses;
use App\Models\Hospitals;
use App\Models\SelfExpenses;
use App\Models\SelfExpensesItems;
use App\Models\FamilyGuardians;
use App\Models\FamilyPeriodExpenses;
use App\Models\GuardianPeriodIncomes;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;

class FujimienForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('基本情報')
                ->schema([
                    TextInput::make('name')
                        ->label('氏名')
                        ->required(),
                    Radio::make('gender')
                        ->label('性別')
                        ->options([
                            'male' => '男',
                            'female' => '女',
                        ])
                        ->inline()
                        ->required(),
                    TextInput::make('name_kana')
                        ->label('氏名(カナ)')
                        ->required(),

                    Grid::make(2)
                        ->schema([
                            DatePicker::make('date_of_birth')
                                ->label('生年月日')
                                ->timezone('Asia/Tokyo')
                                ->native(false)
                                ->displayFormat('Y F d')
                                ->locale('ja')
                                ->required()
                                ->live()
                                ->afterStateUpdated(function (callable $set, $state) {
                                    if ($state) {
                                        $birthDate = \Carbon\Carbon::parse($state);
                                        $age = $birthDate->age;
                                        $set('current_age', $age);
                                    }
                                }),
                            TextInput::make('current_age')
                                ->label('現在年齢')
                                ->numeric()
                                ->readonly(),
                            ]),

                    TextInput::make('town')
                        ->label('町名')
                        ->required(),

                    Grid::make(2)
                        ->schema([
                            DatePicker::make('specified_date')
                                ->label('指定日')
                                ->timezone('Asia/Tokyo')
                                ->native(false)
                                ->displayFormat('Y F d')
                                ->locale('ja')
                                ->live()
                                ->afterStateUpdated(function (callable $set, $state, callable $get) {
                                    if ($state) {
                                        $birthDate = \Carbon\Carbon::parse($get('date_of_birth'));
                                        $specifiedDate = \Carbon\Carbon::parse($state);
                                        $age = $birthDate->diffInYears($specifiedDate);
                                        $set('age_from_specified_date', $age);
                                    }
                                }),
                            TextInput::make('age_from_specified_date')
                                ->label('指定日からの年齢')
                                ->numeric()
                                ->readonly(),
                        ]),

                    Select::make('jurisdictional_id')
                        ->label('管轄事務所')
                        ->searchable()
                        ->preload()
                        ->options(Jurisdictionals::all()->pluck('jurisdictional_office_name', 'id')),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('ふじみ園情報')
                    ->schema([
                        Select::make('status')  
                            ->label('現在ステータス')
                            ->options([
                                'enrolling' => '在園中',
                                'home_training' => '在園中 (居宅訓練)',
                                'welfare_benefits_suspension' => '在園中 (保護費停止)',
                                'hospitalization' => '入院中',
                                'temporary_admission' => '一時入所',    
                                'day_care' => '通所',
                                'day_care_hospitalization' => '通所 (入院中)',
                                'leaving' => '退所',
                            ])
                            ->required(),

                        Grid::make(2)
                        ->schema([
                            DatePicker::make('admission_date')
                                ->label('入所日')
                                ->timezone('Asia/Tokyo')
                                ->native(false)
                                ->displayFormat('Y F d')
                                ->locale('ja'),
                            DatePicker::make('leaving_date')
                                ->label('退所日')
                                ->timezone('Asia/Tokyo')
                                ->native(false)
                                ->displayFormat('Y F d')
                                ->locale('ja'),
                            DatePicker::make('hospitalization_date')
                                ->label('入院日')
                                ->timezone('Asia/Tokyo')
                                ->native(false)
                                ->displayFormat('Y F d')
                                ->locale('ja'),
                            DatePicker::make('discharge_date')
                                ->label('退院日')
                                ->timezone('Asia/Tokyo')
                                ->native(false)
                                ->displayFormat('Y F d')
                                ->locale('ja'),
                            DatePicker::make('day_care_start_date')
                                ->label('通所開始日')
                                ->timezone('Asia/Tokyo')
                                ->native(false)
                                ->displayFormat('Y F d'),
                            DatePicker::make('day_care_end_date')
                                ->label('通所終了日')
                                ->timezone('Asia/Tokyo')
                                ->native(false)
                                ->displayFormat('Y F d')
                                ->locale('ja'),
                            DatePicker::make('home_training_start_date')
                                ->label('居宅訓練開始日')
                                ->timezone('Asia/Tokyo')
                                ->native(false)
                                ->displayFormat('Y F d')
                                ->locale('ja'),
                            DatePicker::make('home_training_end_date')
                                ->label('居宅訓練終了日')
                                ->timezone('Asia/Tokyo')
                                ->native(false)
                                ->displayFormat('Y F d')
                                ->locale('ja'),
                            DatePicker::make('welfare_benefits_suspension_start_date')
                                ->label('保護費停止開始日')
                                ->timezone('Asia/Tokyo')
                                ->native(false)
                                ->displayFormat('Y F d')
                                ->locale('ja'),
                            DatePicker::make('welfare_benefits_resumption_date')
                                ->label('保護費再開日')
                                ->timezone('Asia/Tokyo')
                                ->native(false)
                                ->displayFormat('Y F d')
                                ->locale('ja'),
                            
                        ])
                        ->columns(2)
                        ->columnSpanFull(),
                ])
                ->columns(2)
                ->columnSpanFull(),

                Section::make('')
                    ->schema([
                        Checkbox::make('disability_flag')
                        ->label('障害加算金')
                        ->live()
                        ->afterStateUpdated(function (callable $set, $state) {
                            if ($state) {
                                $set('benefit_flag', false);
                            } else {
                                $set('disability_allowances_grade', null);
                                $set('disability_allowances_amount', 0);
                            }
                        }),

                        Grid::make(2)
                            ->schema([
                                Select::make('disability_allowances_grade')
                                    ->label('等級')
                                    ->options([
                                        'grade_1' => '1級',
                                        'grade_2' => '2級',
                                    ])
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('disability_flag')),
                                TextInput::make('disability_allowances_amount')
                                    ->label('金額')
                                    ->readonly()
                                    ->suffix('円')
                                    ->default(0)
                                    ->hidden(fn (callable $get) => !$get('disability_flag')),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),

                        Checkbox::make('benefit_flag')
                            ->label('給付金')
                            ->live()
                            ->afterStateUpdated(function (callable $set, $state) {
                                if ($state) {
                                    $set('disability_flag', false);
                                    $set('disability_allowances_grade', null);
                                    $set('disability_allowances_amount', 0);
                                }
                            }),

                        Grid::make(2)
                            ->schema([
                                Select::make('disability_allowances_payment_method')
                                    ->label('支払方法')
                                    ->options(function (callable $get) {
                                        if ($get('benefit_flag')) {
                                            return [
                                                'cash' => '現金',
                                                'account' => '口座',
                                                'payment_suspended' => '支給停止',
                                            ];
                                        } else {
                                            return [
                                                'paid_from_pension' => '年金から支給',
                                                'cash' => '現金',
                                                'payment_suspended' => '支給停止',
                                            ];
                                        }
                                    })
                                    ->required()
                                    ->live()
                                    ->hidden(fn (callable $get) => !$get('disability_flag') && !$get('benefit_flag'))
                                    ->afterStateUpdated(function (callable $set, $state, callable $get) {
                                        if ($get('benefit_flag')) {
                                            $set('benefit_payment_method', $state);
                                        }
                                    }),
                            ])
                            ->columnSpanFull(),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('care_worker')
                                    ->label('担当CW'),
                            ])
                            ->columnSpanFull(),
                        
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                
                Section::make('自己負担金')
                    ->schema([
                        TextInput::make('type')
                            ->hidden(),
                        Checkbox::make('pension_flag')
                            ->label('年金')
                            ->live()
                            ->afterStateUpdated(function (callable $set, $state, callable $get) {
                                if ($state) {
                                    $set('type', 'pension');
                                } else {
                                    if (!$get('certificate_of_employment_flag')) {
                                        $set('self_expenses_name', null);
                                        $set('pension_number', null);
                                        $set('payment_method', null);
                                        $set('type', null);
                                    } else {
                                        $set('type', 'certificate_of_employment');
                                    }
                                }
                            }),
                        Grid::make(3)
                            ->schema([
                                TextInput::make('self_expenses_name')
                                    ->label('名称')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('pension_flag')),
                                TextInput::make('pension_number')
                                    ->label('年金番号')
                                    ->hidden(fn (callable $get) => !$get('pension_flag')),
                                Select::make('payment_method')
                                    ->label('支払方法')
                                    ->options([
                                        'cash' => '現金',
                                        'account' => '口座',
                                        'guardian' => '後見人',
                                    ])
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('pension_flag')),
                                    ]),

                            Checkbox::make('certificate_of_employment_flag')
                            ->label('就労認定')
                            ->live()
                            ->afterStateUpdated(function (callable $set, $state, callable $get) {
                                if ($state) {
                                    $set('type', 'certificate_of_employment');
                                } else {
                                    if (!$get('pension_flag')) {
                                        $set('self_expenses_name', null);
                                        $set('pension_number', null);
                                        $set('payment_method', null);
                                        $set('type', null);
                                    } else {
                                        $set('type', 'pension');
                                    }
                                }
                            }),
                        Grid::make(3)
                            ->schema([
                                TextInput::make('self_expenses_name')
                                    ->label('名称')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('certificate_of_employment_flag')),
                                Select::make('payment_method')
                                    ->label('支払方法')
                                    ->options([
                                        'cash' => '現金',
                                        'account' => '口座',
                                    ])
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('certificate_of_employment_flag')),
                                ]),
                    ])
                    ->columnSpanFull(),
                    
                Section::make('請求・戻入情報')
                    ->schema([
                        Checkbox::make('payment_refund_flag')
                                ->label('本人')
                                ->live()
                                ->afterStateUpdated(function (callable $set, $state) {
                                    if (!$state) {
                                        $set('payment_refund_method', null);
                                    }
                                }),
                        Grid::make(2)
                            ->schema([
                                Select::make('payment_refund_method')
                                    ->label('支払・戻入方法 ')
                                    ->options([
                                        'cash' => '現金',
                                        'account' => '口座',
                                    ])
                                    ->required()
                                    ->live()
                                    ->hidden(fn (callable $get) => !$get('payment_refund_flag')),
                            ])
                            ->hidden(fn (callable $get) => !$get('payment_refund_flag')),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('bank_name')
                                    ->label('銀行名')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('payment_refund_flag') || $get('payment_refund_method') !== 'account'),
                                Radio::make('bank_type')
                                    ->label('銀行種別')
                                    ->options([
                                        'hiratsuka_shiyo' => '平信',
                                        'other_bank' => '他銀行',
                                    ])
                                    ->inline()
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('payment_refund_flag') || $get('payment_refund_method') !== 'account'),
                                TextInput::make('branch_name')
                                    ->label('支店名')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('payment_refund_flag') || $get('payment_refund_method') !== 'account'),
                                TextInput::make('account_type')
                                    ->label('口座種別')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('payment_refund_flag') || $get('payment_refund_method') !== 'account'),
                                TextInput::make('account_number')
                                    ->label('口座番号')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('payment_refund_flag') || $get('payment_refund_method') !== 'account'),
                                TextInput::make('account_name')
                                    ->label('口座名義')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('payment_refund_flag') || $get('payment_refund_method') !== 'account'),
                            ])
                            ->columnSpanFull()
                            ->hidden(fn (callable $get) => !$get('payment_refund_flag') || $get('payment_refund_method') !== 'account'),

                        TextInput::make('family_guardian_category')
                            ->hidden(),
                        Checkbox::make('family_flag')
                                ->label('家族負担')
                                ->live()
                                ->afterStateUpdated(function (callable $set, $state, callable $get) {
                                    if ($state) {
                                        $set('family_guardian_category', 'family');
                                    } else {
                                        $set('family_guardian_category', null);
                                    }
                                }),
                        Grid::make(3)
                            ->schema([
                                TextInput::make('name')
                                    ->label('名称')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('family_flag')),
                                TextInput::make('phone')
                                    ->label('電話番号')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('family_flag')),
                                TextInput::make('relationship')
                                    ->label('関係')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('family_flag')),
                            ])
                            ->hidden(fn (callable $get) => !$get('family_flag')),

                        Checkbox::make('guardian_flag')
                            ->label('後見人')
                            ->live()
                            ->afterStateUpdated(function (callable $set, $state, callable $get) {
                                if ($state) {
                                    $set('family_guardian_category', 'guardian');
                                } else {
                                    $set('family_guardian_category', null);
                                }
                            }),
                        Grid::make(3)
                            ->schema([
                                TextInput::make('name')
                                    ->label('名称')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('guardian_flag')),
                                TextInput::make('phone')
                                    ->label('電話番号')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('guardian_flag')),
                                TextInput::make('relationship')
                                    ->label('関係')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('guardian_flag')),
                                TextInput::make('office_name')
                                    ->label('事務所名')
                                    ->required()
                                    ->hidden(fn (callable $get) => !$get('guardian_flag')),
                            ])
                            ->hidden(fn (callable $get) => !$get('guardian_flag')),
                ])
                ->columnSpanFull(),

                Textarea::make('special_notes')
                    ->label('備忘記録')
                    ->columnSpanFull(),
            ]);
        

    }
}
