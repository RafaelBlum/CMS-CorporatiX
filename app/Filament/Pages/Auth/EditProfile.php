<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

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
                                $this->getNameFormComponent(),
                                $this->getEmailFormComponent(),
                                $this->getPasswordFormComponent(),
                                $this->getPasswordConfirmationFormComponent(),
                            ])
                            ->columnSpan(2),
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
