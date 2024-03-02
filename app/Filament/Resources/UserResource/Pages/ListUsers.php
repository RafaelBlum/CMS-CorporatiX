<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ListUsers extends ListRecords
{

    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {

//        $role = DB::table('role')
////            ->inRandomOrder()
////            ->first();
////        dd($role);

        $model = static::getModel()::query();

        $total = $model->count();
        $published = $model->whereStatus(true)->count();
        $unpublished = $total - $published;
//        $adms = $model->where('role.name', '=', 'admin')->count();

        return [
            'all' => Tab::make()
                ->label('Todos')
                ->icon('heroicon-o-list-bullet')
                ->badge($total),
            'active' => Tab::make()
                ->label('Ativos')
                ->icon('heroicon-o-shield-check')
                ->badge($published)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', true)),
            'inactive' => Tab::make()
                ->label('Inativos')
                ->icon('heroicon-o-users')
                ->badge($unpublished)
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', false)),
//            'admins' => Tab::make()
//                ->label('Adm')
//                ->modifyQueryUsing(fn (Builder $query) => $query->where('role.name', '=', 'admin'))
        ];
    }
}
