<?php

namespace App\Filament\Resources\Fujimiens\Pages;

use App\Filament\Resources\Fujimiens\FujimienResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFujimiens extends ListRecords
{
    protected static string $resource = FujimienResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
