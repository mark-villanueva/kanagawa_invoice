<?php

namespace App\Filament\Resources\Fujimiens\Pages;

use App\Filament\Resources\Fujimiens\FujimienResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditFujimien extends EditRecord
{
    protected static string $resource = FujimienResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
