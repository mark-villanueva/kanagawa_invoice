<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected static ?string $title = 'システム利用者　登録';
    protected ?string $heading = 'システム利用者　登録';
    
}
