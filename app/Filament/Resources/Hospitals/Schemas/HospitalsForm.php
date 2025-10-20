<?php

namespace App\Filament\Resources\Hospitals\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TagsInput;
use Filament\Schemas\Schema;

class HospitalsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('基本情報')
                ->description(fn($record) => $record ? "病院コード {$record->id}" : null)
                ->schema([
                    TextInput::make('hospital_name')
                        ->label('病院名')
                        ->required(),
                    TextInput::make('abbreviation')
                        ->label('略称')
                        ->required(),
                    TextInput::make('phone')
                        ->label('電話番号 ')
                        ->required()
                        ->tel(),
                    TextInput::make('fax')
                        ->label('FAX番号'),
                    TextInput::make('postal_code')
                        ->label('郵便番号')
                        ->required(),
                    TextInput::make('address')
                        ->label('住所')
                        ->required(),
                ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('医療施設の詳細情報')
                ->schema([
                    Select::make('hospital_category')
                        ->label('病院区分')
                        ->required()
                        ->options([
                            'general_hospital' => '総合病院',
                            'clinic' => '診療所',
                            'rehabilitation_hospital' => 'リハビリテーション病院',
                            'specialist_hospital' => '専門病院',
                        ]),
                    TagsInput::make('supporting_medical_departments')
                        ->label('対応診療科目')
                        ->suggestions([
                            'psychiatry' => '精神科',
                            'general' => '一般',
                            'internal' => '内科',
                            'surgery' => '外科',
                            'pediatrics' => '小児科',
                            'gynecology' => '産婦人科',
                            'orthopedics' => '整形外科',
                            'dermatology' => '皮膚科',
                            'ophthalmology' => '眼科',
                            'otolaryngology' => '耳鼻咽喉科',
                        ])
                        ->required(),
                    TextInput::make('medical_institution_code')
                        ->label('医療機関コード')
                        ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
                Section::make('期末一時扶助')
                ->schema([
                    TextInput::make('term_end_temporary_assistance_amount')
                        ->label('期末一時扶助金')
                        ->suffix('円')
                        ->disabled()
                        ->dehydrated(false)
                        ->inlineLabel(),
                    ])
                        ->columns(2)
                        ->columnSpanFull(),
                Textarea::make('special_notes')
                    ->label('備忘記録')
                    ->columnSpanFull(),
            ]);
    }
}
