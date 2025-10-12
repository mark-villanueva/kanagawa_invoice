<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('氏名')
                    ->required(),
                TextInput::make('email')
                    ->label('メールアドレス')
                    ->unique()
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('パスワード')
                    ->password()
                    ->required(),
                Select::make('employment_form')
                    ->label('雇用形態')
                    ->required()
                    ->options([
                        'corporation_employed_staff' => '法人雇用職員',
                        'institutionally_employed_staff' => '施設雇用職員',
                        'rehired_staff' => '再雇用職員',
                        'part_time_staff' => 'パート職員',
                        'others' => 'その他'
                    ]),
                // Select::make('system_authority')
                //     ->label('システム権限')
                //     ->required()
                //     ->options([
                //         'administrator' => '管理者',
                //         'general_user' => '一般ユーザー',
                //         'view_only' => '閲覧のみ',
                //     ]),
                Textarea::make('special_notes')
                    ->label('備忘記録')
                    ->columnSpanFull(),
            ]);
    }
}
