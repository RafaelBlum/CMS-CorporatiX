<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Filament\Resources\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;
use Symfony\Component\String\Slugger\SluggerInterface;

class CreateRole extends CreateRecord
{
    protected static string $resource = RoleResource::class;

}
