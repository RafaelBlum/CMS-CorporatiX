<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Filament\Resources\RoleResource\RelationManagers;
use App\Models\Role;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\View\Components\Modal;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;



    protected static ?string $navigationGroup = "Permissões";
    protected static ?string $activeNavigationIcon = 'heroicon-o-hand-raised';

    protected static ?string $pluralModelLabel = "Funções";
    protected static ?string $modelLabel = "Função";

    protected static ?string $navigationIcon = 'heroicon-o-key';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->live(debounce: '1000')
                    ->maxLength(255),

                TextInput::make('slug')
                    ->disabled(true)
                    ->dehydrated()
                    ->unique(ignoreRecord: true),

                TextInput::make('description')
                    ->maxLength(255),

                Select::make('Permições')
                    ->label('Permissões da função')
                    ->multiple()
                    ->preload()
                    ->relationship('permissions', 'name'),

                Toggle::make('deletable')
                    ->disabled(($form->getOperation() == 'create' ? false: ($form->model->deletable != true && $form->model->id == 1 || $form->model->id == 2 ? true : false)))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('slug')
                    ->searchable(),



                TextColumn::make('description')
                    ->searchable(),

                IconColumn::make('deletable')
                    ->boolean(),
            ])
            ->filters([
        //
    ])
        ->actions([
            ActionGroup::make([
                EditAction::make(),
            ])->tooltip("Menu")
        ])
        ->bulkActions([
            BulkActionGroup::make([

            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PermissionsRelationManager::class,
            RelationManagers\UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user()->status;
    }
}
