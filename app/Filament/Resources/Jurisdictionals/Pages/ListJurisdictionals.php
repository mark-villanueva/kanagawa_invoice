<?php

namespace App\Filament\Resources\Jurisdictionals\Pages;

use App\Filament\Resources\Jurisdictionals\JurisdictionalsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJurisdictionals extends ListRecords
{
    protected static string $resource = JurisdictionalsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
