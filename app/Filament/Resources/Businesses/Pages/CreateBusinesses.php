<?php

namespace App\Filament\Resources\Businesses\Pages;

use App\Filament\Resources\Businesses\BusinessesResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBusinesses extends CreateRecord
{
    protected static string $resource = BusinessesResource::class;

    protected static ?string $title = '事業者　登録';
    protected ?string $heading = '事業者　登録';
}
