<?php

namespace App\Filament\Resources\Businesses\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BusinessesInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('facility'),
                TextEntry::make('corporate'),
                TextEntry::make('phone'),
                TextEntry::make('fax'),
                TextEntry::make('representative'),
                TextEntry::make('postal_code'),
                TextEntry::make('address'),
                TextEntry::make('financial_institution'),
                TextEntry::make('branch_name'),
                TextEntry::make('deposit_type'),
                TextEntry::make('account_number'),
                TextEntry::make('payee_name'),
                TextEntry::make('payee_name_kana'),
                TextEntry::make('registration_category'),
                TextEntry::make('number_code'),
                TextEntry::make('registration_number'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('deleted_at')
                    ->dateTime(),
            ]);
    }
}
