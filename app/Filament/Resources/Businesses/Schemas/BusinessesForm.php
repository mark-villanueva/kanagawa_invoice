<?php

namespace App\Filament\Resources\Businesses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

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

                Textarea::make('special_notes')
                ->label('備忘記録')
                ->columnSpanFull(),
            ]);
    }
}
