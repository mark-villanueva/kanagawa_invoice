<?php

namespace App\Filament\Resources\Businesses\Schemas;

use App\Models\Units;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\HtmlString;

class BusinessesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('基本情報')
                ->schema([
                    TextInput::make('facility')
                        ->label('施設名')
                        ->required(),
                    TextInput::make('corporate')
                        ->label('法人名')
                        ->required(),
                    TextInput::make('phone')
                        ->tel()
                        ->maxValue(11)
                        ->label('電話番号')
                        ->required(),
                    TextInput::make('representative')
                        ->label('代表名')
                        ->required(),
                    TextInput::make('fax')
                        ->maxValue(11)
                        ->label('FAX番号')
                        ->tel()
                        ->maxValue(11)
                        ->required(),
                    TextInput::make('postal_code')
                        ->tel()
                        ->maxValue(11)
                        ->label('郵便番号')
                        ->required(),
                    TextInput::make('address')
                        ->label('住所')
                        ->required(),
                ])
                ->columns(2)
                ->columnSpanFull()
                ->collapsible(),

                Section::make('支払情報')
                ->schema([
                    Radio::make('registration_category')
                        ->hiddenLabel()
                        ->options([
                            'account_information' => '口座情報',
                            'code' => 'コード',
                            ])
                        ->inline()
                        ->default('account_information')
                        ->reactive()
                        ->columnSpanFull(),
                    TextInput::make('financial_institution')
                        ->label('振込先金融機関名')
                        ->required()
                        ->visible(fn ($get) => $get('registration_category') === 'account_information'),
                    TextInput::make('branch_name')
                        ->label('支店名')
                        ->required()
                        ->visible(fn ($get) => $get('registration_category') === 'account_information'),
                    TextInput::make('deposit_type')
                        ->label('預金種別')
                        ->required()
                        ->visible(fn ($get) => $get('registration_category') === 'account_information'),
                    TextInput::make('account_number')
                        ->label('口座番号')
                        ->required()
                        ->visible(fn ($get) => $get('registration_category') === 'account_information'),
                    TextInput::make('payee_name')
                        ->label('振込先名義')
                        ->required()
                        ->visible(fn ($get) => $get('registration_category') === 'account_information'),
                    TextInput::make('payee_name_kana')
                        ->label('振込先名義 (カナ)')
                        ->required()
                        ->visible(fn ($get) => $get('registration_category') === 'account_information'),
                    Select::make('code_type')
                        ->label('コード種別')
                        ->options([
                            'number_code' => '債権者コード',
                            'registration_number' => '登録番号',
                        ])
                        ->required()
                        ->reactive()
                        ->visible(fn ($get) => $get('registration_category') === 'code'),
                    TextInput::make('number_code')
                        ->label('債権者コード')
                        ->required()
                        ->numeric()
                        ->visible(fn ($get) => $get('registration_category') === 'code' && $get('code_type') === 'number_code'),
                    TextInput::make('registration_number')
                        ->label('登録番号')
                        ->required()
                        ->numeric()
                        ->visible(fn ($get) => $get('registration_category') === 'code' && $get('code_type') === 'registration_number'),

                ])
                ->columns(2)
                ->columnSpanFull(),

                Section::make('金種指定')
                    ->schema([
                        Repeater::make('moneyDenoms')
                            ->relationship()
                            ->hiddenLabel()
                            ->schema([
                                // TextInput::make('money_denomination_name')
                                //     ->label('金種名')
                                //     ->required()
                                //     ->disabled()
                                //     ->formatStateUsing(function ($state) {
                                //         $labels = [
                                //             'disability_allowances_grade_1' => '障害加算金　1級',
                                //             'disability_allowances_grade_2' => '障害加算金　2級',
                                //             'benefit' => '給付金',
                                //         ];
                                //         return $labels[$state] ?? $state;
                                //     }),
                                
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('ten_thousand_yen')
                                            ->label('10,000 円')
                                            ->numeric()
                                            ->suffix('枚')
                                            ->default(0)
                                            ->live()
                                            ->afterStateUpdated(function (callable $get, callable $set) {
                                                self::calculateTotal($get, $set);
                                            }),
                                        TextInput::make('five_thousand_yen')
                                            ->label('5,000 円')
                                            ->numeric()
                                            ->suffix('枚')
                                            ->default(0)
                                            ->live()
                                            ->afterStateUpdated(function (callable $get, callable $set) {
                                                self::calculateTotal($get, $set);
                                            }),
                                        TextInput::make('thousand_yen')
                                            ->label('1,000 円')
                                            ->numeric()
                                            ->suffix('枚')
                                            ->default(0)
                                            ->live()
                                            ->afterStateUpdated(function (callable $get, callable $set) {
                                                self::calculateTotal($get, $set);
                                            }),
                                        TextInput::make('five_hundred_yen')
                                            ->label('500 円')
                                            ->numeric()
                                            ->suffix('枚')
                                            ->default(0)
                                            ->live()
                                            ->afterStateUpdated(function (callable $get, callable $set) {
                                                self::calculateTotal($get, $set);
                                            }),
                                        TextInput::make('hundred_yen')
                                            ->label('100 円')
                                            ->numeric()
                                            ->suffix('枚')
                                            ->default(0)
                                            ->live()
                                            ->afterStateUpdated(function (callable $get, callable $set) {
                                                self::calculateTotal($get, $set);
                                            }),
                                        TextInput::make('fifty_yen')
                                            ->label('50 円')
                                            ->numeric()
                                            ->suffix('枚')
                                            ->default(0)
                                            ->live()
                                            ->afterStateUpdated(function (callable $get, callable $set) {
                                                self::calculateTotal($get, $set);
                                            }),
                                        TextInput::make('ten_yen')
                                            ->label('10 円')
                                            ->numeric()
                                            ->suffix('枚')
                                            ->default(0)
                                            ->live()
                                            ->afterStateUpdated(function (callable $get, callable $set) {
                                                self::calculateTotal($get, $set);
                                            }),
                                        TextInput::make('five_yen')
                                            ->label('5 円')
                                            ->numeric()
                                            ->suffix('枚')
                                            ->default(0)
                                            ->live()
                                            ->afterStateUpdated(function (callable $get, callable $set) {
                                                self::calculateTotal($get, $set);
                                            }),
                                        TextInput::make('one_yen')
                                            ->label('1 円')
                                            ->numeric()
                                            ->suffix('枚')
                                            ->default(0)
                                            ->live()
                                            ->afterStateUpdated(function (callable $get, callable $set) {
                                                self::calculateTotal($get, $set);
                                            }),
                                    ])
                                    ->columnSpanFull(),
                                
                                TextInput::make('total')
                                    ->label('合計')
                                    ->suffix('円')
                                    ->disabled()
                                    ->dehydrated()
                                    ->default(0)
                                    ->live()
                                    ->formatStateUsing(fn ($state) => $state ? number_format((int) $state, 0, '.', ',') : '0')
                                    ->rules([
                                        function (callable $get) {
                                            return function (string $attribute, $value, \Closure $fail) use ($get) {
                                                $denominationName = $get('money_denomination_name');
                                                
                                                if ($denominationName) {
                                                    $unit = Units::where('fee_name', $denominationName)
                                                        ->orderBy('created_at', 'desc')
                                                        ->first();
                                                    
                                                    $scheduledAmount = $unit?->scheduled_amount ?? 0;
                                                    $total = (int) $value;
                                                    
                                                    if ($total !== $scheduledAmount) {
                                                        $formattedScheduled = number_format($scheduledAmount);
                                                        $formattedTotal = number_format($total);
                                                        $fail("合計金額は {$formattedScheduled} 円である必要があります。現在の合計: {$formattedTotal} 円");
                                                    }
                                                }
                                            };
                                        },
                                    ]),
                            ])
                            ->columns(3)
                            ->itemLabel(function (array $state) {
                                $labels = [
                                    'disability_allowances_grade_1' => '障害加算金　1級',
                                    'disability_allowances_grade_2' => '障害加算金　2級',
                                    'benefit' => '給付金',
                                ];
                                
                                $denominationName = $state['money_denomination_name'] ?? '';
                                $label = $labels[$denominationName] ?? '新規金種';
                                
                                if ($denominationName) {
                                    $unit = Units::where('fee_name', $denominationName)
                                        ->orderBy('created_at', 'desc')
                                        ->first();
                                    
                                    $amount = $unit?->scheduled_amount ?? 0;
                                    $formattedAmount = $amount ? number_format($amount) : '0';
                                    
                                    return new HtmlString("<strong>{$label} = {$formattedAmount} 円 </strong>");
                                }
                                
                                return $label;
                            })
                            ->collapsible()
                            ->defaultItems(3)
                            ->addable(false)
                            ->deletable(false)
                            ->reorderable(false)
                            ->reorderableWithDragAndDrop(false)
                            ->default([
                                ['money_denomination_name' => 'disability_allowances_grade_1'],
                                ['money_denomination_name' => 'disability_allowances_grade_2'],
                                ['money_denomination_name' => 'benefit'],
                            ])
                    ])
                    ->columnSpanFull(),

                Textarea::make('special_notes')
                ->label('備忘記録')
                ->columnSpanFull(),
            ]);
    }

    private static function calculateTotal(callable $get, callable $set): void
    {
        $denominations = [
            'ten_thousand_yen' => 10000,
            'five_thousand_yen' => 5000,
            'thousand_yen' => 1000,
            'five_hundred_yen' => 500,
            'hundred_yen' => 100,
            'fifty_yen' => 50,
            'ten_yen' => 10,
            'five_yen' => 5,
            'one_yen' => 1,
        ];

        $total = 0;
        foreach ($denominations as $field => $value) {
            $quantity = (int) ($get($field) ?? 0);
            $total += $quantity * $value;
        }

        $set('total', $total);
    }
}
