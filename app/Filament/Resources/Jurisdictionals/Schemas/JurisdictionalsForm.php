<?php

namespace App\Filament\Resources\Jurisdictionals\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Radio;
use App\Models\Businesses;
use App\Models\Jurisdictionals;

class JurisdictionalsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('基本情報')
                ->schema([
                    TextInput::make('jurisdictional_office_name')
                        ->label('管轄事務所名')
                        ->required(),
                    TextInput::make('postal_code')
                        ->label('郵便番号 ')
                        ->required(),
                    Select::make('prefecture_city')
                        ->label('県市部 ')
                        ->required()
                        ->options([
                            'yokohama_city' => '横浜市',
                            'kawasaki_city' => '川崎市',
                            'yokosuka_city' => '横須賀市',
                            'sagamihara_city' => '相模原市',
                            'other_cities' => '県内市部',
                            'outside_the_prefecture' => '県外',
                        ]),
                    TextInput::make('phone')
                        ->label('電話番号')
                        ->tel()
                        ->required(),
                    TextInput::make('abbreviation')
                        ->label('略称')
                        ->required(),
                    TextInput::make('address')
                        ->label('住所')
                        ->required(),
                    TextInput::make('jurisdictional_office_code')
                        ->label('管轄事務所コード')
                        ->required(),
                    TextInput::make('fax')
                        ->label('FAX番号')
                        ->tel()
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                
                Section::make('請求情報')
                ->schema([
                    TextInput::make('bill_to')
                        ->label('宛先名'),
                    Select::make('business_id')
                        ->label('事業者コード ')
                        ->required()
                        ->options(Businesses::all()->mapWithKeys(function($business) {
                            return [$business->id => "{$business->id} - {$business->facility}"];
                        }))
                        ->searchable()
                        ->preload(),
                    Radio::make('administrative_costs_invoice')
                        ->options([
                            '0' => 'なし',
                            '1' => 'あり',
                        ])
                        ->inline()
                        ->default('no')
                        ->label('事務費請求書')
                        ->required(),
                    Select::make('term_end_temporary_assistance')
                        ->label('期末一時扶助')
                        ->required()    
                        ->options([
                            'full_payment' => '全額負担',
                            'partial_payment' => '一部負担',
                            'paid_from_pension' => '年金から支給',
                        ]),
                    Select::make('first_decimal_place')
                        ->label('小数第一位')
                        ->required()
                        ->options([
                            'round' => '四捨五入',
                            'round_down' => '切り捨て',
                            'none' => 'なし',
                        ]),
                    Select::make('second_decimal_place')
                        ->label('小数第二位 ')
                        ->required()
                        ->options([
                            'round' => '四捨五入',
                            'round_down' => '切り捨て',
                            'none' => 'なし',
                        ]),
                    Radio::make('one_yen_adjustment')
                        ->label('一円調整')
                        ->options([
                            '0' => 'なし',
                            '1' => 'あり',
                        ])
                        ->inline()
                        ->default('no')
                        ->required(),
                    Radio::make('date_print_on_invoice')
                        ->label('請求書日付の印字')
                        ->options([
                            '0' => 'なし',
                            '1' => 'あり',
                        ])
                        ->inline()
                        ->default('no')
                        ->required()
                    ])
                        ->columns(2)
                        ->columnSpanFull(),
                    Textarea::make('special_notes')
                    ->label('備忘記録')
                    ->columnSpanFull(),
            ]);
    }
}
