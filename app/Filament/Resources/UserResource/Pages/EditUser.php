<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }


    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Usuário atualizado com sucesso.')
            ->body('Dados do usuário processado...')
            ->success()
            ->send();
    }

    protected function handleRecordEdit(array $data): Model
    {
        dd($data);
        $record =  static::getModel()::create($data);
        $record->address()->create($data['address']);

        return $record;
    }
}
