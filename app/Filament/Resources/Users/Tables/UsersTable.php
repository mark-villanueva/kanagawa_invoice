<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('氏名'),
                TextColumn::make('email')
                    ->label('メールアドレス'),
                TextColumn::make('employment_form')
                    ->label('雇用形態')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'corporation_employed_staff' => '法人雇用職員',
                            'institutionally_employed_staff' => '施設雇用職員',
                            'rehired_staff' => '再雇用職員',
                            'part_time_staff' => 'パート職員',
                            'others' => 'その他',
                        };
                    }),
                TextColumn::make('system_authority')
                    ->label('システム権限')
                    ->formatStateUsing(function ($state) {
                        return match ($state) {
                            'administrator' => '管理者',
                            'general_user' => '一般ユーザー',
                            'view_only' => '閲覧のみ',
                        };
                    }),
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
