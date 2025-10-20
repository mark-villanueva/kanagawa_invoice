<?php

namespace App\Filament\Resources\Jurisdictionals\Pages;

use App\Filament\Resources\Jurisdictionals\JurisdictionalsResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditJurisdictionals extends EditRecord
{
    protected static string $resource = JurisdictionalsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
