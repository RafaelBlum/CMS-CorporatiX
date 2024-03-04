<?php

namespace App\Filament\Pages;

use App\Forms\Components\CustomPlasceHolder;
use App\Models\Setting;
use Exception;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;


class Settings extends Page
{
    protected static ?string $model = Setting::class;

    /**
     * Passo para customização de paginas:
     * Creating a page [https://filamentphp.com/docs/3.x/panels/pages]
     *      - php artisan make:filament-page Settings
     * Options [Creating a custom theme]
     *      - Pode modificar o theme do filament (opcional)
     * Form schemas [https://filamentphp.com/docs/3.x/forms/adding-a-form-to-a-livewire-component]
     *      - Adicionando o esquema de formulario do filament
     *              - {{ $this->form }}
     *
     * Custom fields [https://filamentphp.com/docs/3.x/forms/fields/custom]
     *      - php artisan make:form-field CustomPlasceHolder
     *              - app/forms/Components
     *              - resources/views/forms/components
     *
     */
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $activeNavigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationLabel = "Configurações";

    protected static string $view = 'filament.pages.settings';
    /**
     * @param Setting $settings ;
     */
    public Setting $settings;
    public ?array $data = [];

    public function mount(): void
    {
        $this->settings = Setting::first();

        $this->form->fill([
            'header_name' => $this->settings->header_name,
            'header_title' => $this->settings->header_title,
            'header_description' => $this->settings->header_description,
            'section_title' => $this->settings->section_title,
            'section_subtitle' => $this->settings->section_subtitle,
            'section_description' => $this->settings->section_description,
            'footer_phone' => $this->settings->footer_phone,
            'footer_email' => $this->settings->footer_email,
            'section_about' => $this->settings->section_about,
            'header_logo_url' => $this->settings->header_logo_url,
            'section_logo_url' => $this->settings->section_logo_url,
            'head_icon' => $this->settings->head_icon,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                CustomPlasceHolder::make('title')
                    ->label('Informações gerais')
                    ->content('Personalização das informações do site institucional')->columnSpan(3),

                /**
                 * ASIDE COMPONENTS
                 */
                Group::make()->schema([

                    // ** Avatar user
                    Section::make()->schema([
                        CustomPlasceHolder::make('Placeholder')
                            ->label('Imagem principal site')
                            ->content('Somente PNG. Max size of 1024'),

                        FileUpload::make('header_logo_url')
                            ->disableLabel(true)
                            ->disk('public')
                            ->acceptedFileTypes(['image/png'])
                            ->directory('setting_images')
                        ,
                    ]),

                    Section::make()->schema([

                        Section::make()->schema([

                            CustomPlasceHolder::make('section_logo_url')
                                ->label('Image de sessão')
                                ->content('JPG ou PNG. Max size of 1024')->columnSpan(2),

                            FileUpload::make('section_logo_url')
                                ->disableLabel(true)
                                ->disk('public')
                                ->directory('setting_images')
                                ->image()
                                ->avatar()
                                ->imageEditor()
                                ->circleCropper()
                                ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg', 'image/webp']),


                        ])->columnSpan(1),

                        Section::make()->schema([

                            CustomPlasceHolder::make('head_icon')
                                ->label('Imagem favicon')
                                ->content('JPG ou PNG. Max size of 1024')->columnSpan(2),

                            FileUpload::make('head_icon')
                                ->disableLabel(true)
                                ->disk('public')
                                ->directory('setting_images')
                                ->image()
                                ->imageEditor()
                                ->avatar()
                                ->imageEditorAspectRatios([
                                    null,
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->imageEditorViewportWidth('1920')
                                ->imageEditorViewportHeight('1080')
                                ->openable()
                                ->acceptedFileTypes(['image/png', 'image/jpeg']),


                        ])->columnSpan(1),

                    ])->columnSpan(2)->columns(2),
                ])->columnSpan(1)->columns(1),


                /**
                 * CONTENTS COMPONENTS
                 */
                Group::make()->schema([

                    // ** Data user
                    Section::make()->schema([
                        TextInput::make('header_name')
                            ->label('Nome site principal'),
                        TextInput::make('header_title')
                            ->label('Titulo do banner principal'),
                        TextInput::make('header_description')
                            ->label('Descrição banner resumida'),
                        TextInput::make('section_title')
                            ->label('Titulo da sessão'),
                        TextInput::make('section_subtitle')
                            ->label('SubTitulo sessão'),
                        TextInput::make('section_description')
                            ->label('Descrição de sessão resumida'),
                        TextInput::make('footer_phone')
                            ->label('Telefone')->mask('(99) 99999-9999'),
                        TextInput::make('footer_email')
                            ->label('E-mail institucional principal'),


                        RichEditor::make('section_about')
                            ->label('section_about')->columnSpan(2),

                        /**
                         * last_acess - Important
                         */

                    ])->columnSpan(2)->columns(2),


                ])->columnSpan(2)->columns(2),


            ])->statePath('data')->columns([
                'default' => 2,
                'sm' => 1,
                'md' => 2,
                'lg' => 2,
                'xl' => 2,
                '2xl' => 2
            ]);
    }


    public function submit(): void
    {
        $data = $this->form->getState();
        try {

            $this->settings->update($data);

            Notification::make()
                ->title('Configurações gerais finalizadas com sucesso!')
                ->body('Todos processos solicitados foram feitos...')
                ->success()
                ->send();
        } catch (Exception $e) {
            dd($e->getMessage());
            Notification::make()
                ->title('Erro ao tentar enviar')
                ->body('Algum erro ocorreu ao tentar atualizar as configurações gerais...' . $e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function hasFullWidthFormActions(): bool
    {
        return false;
    }
}
