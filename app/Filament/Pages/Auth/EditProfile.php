<?php

namespace App\Filament\Pages\Auth;

use App\Forms\Components\HeaderProfileUser;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Infolists\Components\ViewEntry;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Tables\Columns\TextColumn;
use App\Enums\MaritalStatusEnum;

class EditProfile extends BaseEditProfile
{
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
// Path profile edit personalizado
    protected static string $view = 'filament.pages.auth.edit-profile';
    protected static string $layout = 'filament-panels::components.layout.index';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)
                    ->schema([

                        Section::make()
                            ->schema([
                                FileUpload::make('avatar')
                                    ->label('')
                                    ->disk('public')
                                    ->directory('setting_images'),
                            ])
                            ->columnSpan(1),

                        Section::make()
                            ->schema([

                                HeaderProfileUser::make($form->model)
                                    ->columnSpanFull(),

                                Grid::make(4)->schema([
                                    Group::make()->schema([
                                        $this->getNameFormComponent(),
                                    ])->columnSpan(2),

                                    Group::make()->schema([
                                        $this->getEmailFormComponent(),
                                    ])->columnSpan(2),
                                ])->columnSpanFull(),

                                Grid::make(4)->schema([
                                    Group::make()->schema([
                                        $this->getPasswordFormComponent(),
                                    ])->columnSpan(function (Get $get, Set $set) {
                                        if( $get('password') == null){
                                            return 4;
                                        }else{
                                            return 2;
                                        }
                                    }),

                                    Group::make()->schema([
                                        $this->getPasswordConfirmationFormComponent(),
                                    ])->columnSpan(2),
                                ])->columnSpanFull(),




                            ])
                            ->columnSpan(2),

                        Tabs::make('informations')->tabs([
                            Tab::make('Minhas informações')->icon('heroicon-m-identification')
                                ->schema([





                                    Grid::make(4)->schema([
                                        Group::make()->schema([

                                            TextInput::make('academic_education')
                                                ->label('Educação')
                                                ->maxLength(255),


                                            Grid::make(4)->schema([
                                                Group::make()->schema([
                                                    TextInput::make('phone')
                                                        ->label('')
                                                        ->prefixIcon('heroicon-m-phone-arrow-down-left')
                                                        ->suffixIconColor('success')
                                                        ->mask('(99) 99999-9999'),
                                                ])->columnSpan(2),

                                                Group::make()->schema([
                                                    TextInput::make('branch_line')
                                                        ->label('')
                                                        ->prefix('Ramal')
                                                        ->mask('999-999'),
                                                ])->columnSpan(2),
                                            ])->columnSpanFull(),


                                            Grid::make(4)->schema([
                                                Group::make()->schema([
                                                    Select::make('marital_status')
                                                        ->label('Estado civil')
                                                        ->options(MaritalStatusEnum::class)
                                                        ->native(false),
                                                ])->columnSpan(2),

                                                Group::make()->schema([
                                                    DatePicker::make('birth')
                                                        ->label('Data de aniversário')
                                                        ->displayFormat(function () {
                                                            return 'd/m/Y';
                                                        }),
                                                ])->columnSpan(2),
                                            ])->columnSpanFull(),





                                        ])->columnSpan(2),

                                        Group::make()->schema([

                                                Textarea::make('bio')
                                                    ->label('Sua biografia')
                                                    ->rows(9)
                                                    ->cols(20)
                                                    ->columnSpanFull(),

                                        ])->columnSpan(2),
                                    ])->columnSpanFull(),

                                ])->columns(3),

                            Tab::make('Endereço')->icon('heroicon-m-home-modern')
                                ->schema([
                                    Section::make()->schema([
                                        Group::make()
                                            ->relationship('address')
                                            ->schema([

                                                Grid::make(4)->schema([
                                                    Group::make()->schema([
                                                        TextInput::make('street')
                                                            ->label('Rua'),
                                                    ])->columnSpan(3),

                                                    Group::make()->schema([
                                                        TextInput::make('number')
                                                            ->label('Numero'),
                                                    ])->columnSpan(1),
                                                ])->columnSpanFull(),


                                                Grid::make(8)->schema([
                                                    Group::make()->schema([
                                                        TextInput::make('bairro')
                                                            ->label('Bairro'),
                                                    ])->columnSpan(2),

                                                    Group::make()->schema([
                                                        TextInput::make('city')
                                                            ->label('Cidade'),
                                                    ])->columnSpan(2),

                                                    Group::make()->schema([
                                                        TextInput::make('state')
                                                            ->label('Estado'),
                                                    ])->columnSpan(2),

                                                    Group::make()->schema([
                                                        TextInput::make('cep')
                                                            ->label('CEP'),
                                                    ])->columnSpan(2),

                                                ])->columnSpanFull(),










                                            ]),


                                    ])->columnSpan(3),
                                ]),

                             Tab::make('Permissões')->icon('heroicon-m-home-modern')
                                 ->schema([

                                 ]),

                            Tab::make('Meus artigos')->icon('heroicon-m-home-modern')
                                ->schema([

                                ]),

                        ])->columnSpanFull()->activeTab(1)->persistTabInQueryString(),

                    ]),
            ])->statePath('data')->columns([
                'default' => 2,
                'sm' => 1,
                'md' => 2,
                'lg' => 2,
                'xl' => 2,
                '2xl' => 2
            ]);
    }

    protected function hasFullWidthFormActions(): bool
    {
        return false;
    }

    public static function getSlug(): string
    {
        return static::$slug ?? 'perfil';
    }
}
