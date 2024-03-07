<?php

namespace App\Filament\Resources;

use App\Enums\MaritalStatusEnum;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Forms\Components\CustomPlasceHolder;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Components\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
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

    protected static ?string $modelLabel = "Usuário";

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Grid::make(3)->schema([

                        Section::make()->schema([
                                FileUpload::make('avatar')
                                    ->label('')
                                    ->disk('public')
                                    ->directory('thumbnails')->columnSpanFull()
                            ])
                            ->columnSpan(1),

                        Section::make()->schema([
                                Grid::make(3)->schema([
                                    Group::make()->schema([

                                        TextInput::make('name')
                                            ->label('Nome completo')
                                            ->required()
                                            ->maxLength(150),
                                    ])->columnSpan(1),

                                    Group::make()->schema([
                                        TextInput::make('email')
                                            ->label('E-mail')
                                            ->email()
                                            ->required()
                                            ->maxLength(255),

                                    ])->columnSpan(2),
                                ]),

                                Grid::make(3)->schema([
                                    Group::make()->schema([
                                        Select::make('marital_status')
                                            ->label('Estado civil')
                                            ->options(MaritalStatusEnum::class)
                                            ->native(false),

                                    ])->columnSpan(1),

                                    Group::make()->schema([
                                        TextInput::make('password')
                                            ->label('Senha')
                                            ->password()
                                            ->required()
                                            ->minLength(3)
                                            ->maxLength(255),
                                    ])->columnSpan(2),
                                ]),

                                Grid::make(11)->schema([
                                    Group::make()->schema([
                                        Toggle::make('status')
                                            ->label('Acesso')
                                            ->onColor('success')
                                            ->offColor('danger')
                                            ->inline(false),

                                    ])->columnSpan(1),

                                    Group::make()->schema([
                                        DatePicker::make('birth')
                                            ->label('Data de aniversário')
                                            ->displayFormat(function () {
                                                return 'd/m/Y';
                                            }),
                                    ])->columnSpan(5),

                                    Group::make()->schema([
                                        Select::make('role_id')
                                            ->label('Função do usuário')
                                            ->preload()
                                            ->relationship('role', 'name'),
                                    ])->columnSpan(5),
                                ]),

                            ])
                            ->columnSpan(2),
                    ]),

                Grid::make(3)->schema([
                        Section::make()->schema([
                            TextInput::make('academic_education')
                                ->label('Educação')
                                ->maxLength(255),
                            TextInput::make('phone')
                                ->label('WhatApp')
                                ->mask('(99) 99999-9999'),
                            TextInput::make('branch_line')
                                ->label('Ramal')
                                ->mask('999-999'),
//                            dd($form->model->address->street),
                            TextInput::make('address.street')
                                ->label('Rua'),
                        ])
                        ->columnSpan(1),

                        Section::make()->schema([
                            Textarea::make('bio')
                                ->label('Sua biografia')
                                ->rows(9)
                                ->cols(20)
                                ->columnSpanFull(),
                        ])
                        ->columnSpan(2),
                    ]),

                ])->columns([
                'default' => 2,
                'sm' => 1,
                'md' => 2,
                'lg' => 2,
                'xl' => 2,
                '2xl' => 2
            ]);
    }

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
                ImageColumn::make('avatar')
                    ->circular()
                    ->defaultImageUrl(url('storage/app/public/thumbnails'))
                    ->label(''),

                TextColumn::make('name')
                    ->label('Nome')
                    ->description(function (User $record) {
                        return ($record->role->name === "admin" ? 'Acesso administrativo':'acesso aplicativo');
                    })
                    ->searchable(),

                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),

                TextColumn::make('role.name')
                    ->label('Função')
                    ->sortable()
                    ->searchable()
                    ->badge(),

                IconColumn::make('status')
                    ->sortable()
                    ->boolean(),

                TextColumn::make('articles_count')
                    ->counts('articles')
                    ->label('Artigos'),

                TextColumn::make('phone')
                    ->label('WhatApp')
                    ->searchable(),

                TextColumn::make('address.street')
                    ->label('Rua')
                    ->searchable(),


            ])
            ->filters([
                //
            ])
            ->actions([
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
            RelationManagers\AddressRelationManager::class,
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
