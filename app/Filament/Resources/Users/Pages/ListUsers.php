<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'システム利用者一覧';
    protected ?string $heading = 'システム利用者一覧';

  

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('＋新規登録'),
        ];
    }
}
