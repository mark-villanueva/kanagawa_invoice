<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'システム利用者　詳細';
    protected ?string $heading = 'システム利用者　詳細';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
