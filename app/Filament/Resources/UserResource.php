<?php

namespace App\Filament\Resources;

use App\Enums\PanelTypeEnum;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Components\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use stdClass;

class UserResource extends Resource
{

    protected static ?string $model = User::class;

    protected static ?string $navigationGroup = "Admin Usuários";
    protected static ?string $activeNavigationIcon = 'heroicon-o-users';

    protected static ?string $pluralModelLabel = "Usuários";
    protected static ?string $modelLabel = "Usuário";

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    /**
     * Filtros em formato de guias: app\Traits\HasTablePublishedTabs
     *
     *
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make()
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                        '2xl' => 2,
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(150),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required()
                            ->maxLength(255),

                        Select::make('role_id')
                            ->label('Função do usuário')
                            ->preload()
                            ->relationship('role', 'name'),

                    ]),


                Forms\Components\Toggle::make('status')
                    ->onColor('success')
                    ->offColor('danger'),

                DatePicker::make('birth')
                    ->displayFormat(function () {
                        return 'd/m/Y';
                    }),


                Forms\Components\Textarea::make('bio')
                    ->columnSpanFull(),

                Forms\Components\Select::make('marital_status')
                    ->label('Estado civil')
                    ->options(PanelTypeEnum::class)
                    ->native(false)
                    ->required(),


                Forms\Components\TextInput::make('academic_education')
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->mask('(99) 99999-9999'),
                Forms\Components\TextInput::make('branch_line')
                    ->numeric()->mask('999-999'),
                FileUpload::make('avatar')
                    ->disk('public')
                    ->directory('thumbnails')->columnSpanFull(),
            ]);
    }

    /**
     *
     *
     *
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string)(
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                    $livewire->getTablePage() - 1
                                ))
                        );
                    }
                ),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('articles_count')->counts('articles')->label('Artigos'),

                Tables\Columns\IconColumn::make('status')
                    ->boolean(),

                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),

                Tables\Columns\ImageColumn::make('avatar')
                    ->circular()
                    ->defaultImageUrl(url('storage/app/public/thumbnails'))
                    ->label('Imagem'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    /**
     * Page profile user - InfoList
     */
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            \Filament\Infolists\Components\Section::make([
                TextEntry::make('name')
                    ->size('lg')->weight('bold')->hiddenLabel(),

            ]),
        ])->columns(3);
    }

    /**
     *
     */
    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'active' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', true)),
            'inactive' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', false)),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ArticlesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => UserResource\Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', '=', true)->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::where('status', '=', true)->count() < 10
            ? 'success'
            : 'warning';
    }
}
