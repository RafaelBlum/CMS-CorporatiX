<?php

namespace App\Filament\Resources\PermissionsResource\Pages;

use App\Filament\Resources\PermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePermissions extends CreateRecord
{
    protected static string $resource = PermissionResource::class;
}
