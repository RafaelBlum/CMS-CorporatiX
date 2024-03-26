<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\ViewEntry;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Tables\Columns\TextColumn;

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

                        //dd(static::getId(), static::getName(), $form->model),
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
                                $this->getNameFormComponent(),
                                $this->getEmailFormComponent(),
                                $this->getPasswordFormComponent(),
                                $this->getPasswordConfirmationFormComponent(),
                            ])
                            ->columnSpan(2),

                        Section::make()->schema([
                            Group::make()
                                ->relationship('address')
                                ->schema([
                                    TextInput::make('street')
                                        ->label('Rua'),

                                    TextInput::make('number')
                                        ->label('Numero'),

                                    TextInput::make('bairro')
                                        ->label('Bairro'),

                                    TextInput::make('city')
                                        ->label('Cidade'),

                                    TextInput::make('state')
                                        ->label('Estado'),

                                    TextInput::make('cep')
                                        ->label('CEP'),
                                ]),


                        ])->columnSpan(3),

                        Section::make('user')
                            ->hiddenLabel()
                            ->view('filament/user/user-data', ['user' => $form->model]),


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
