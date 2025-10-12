<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->label('氏名'),
                TextEntry::make('email')
                    ->label('メールアドレス'),
                TextEntry::make('employment_form')
                    ->label('雇用形態'),
                TextEntry::make('system_authority')
                    ->label('システム権限'),
            ]);
    }
}
