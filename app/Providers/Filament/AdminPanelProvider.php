<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Auth\EditProfile;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Contracts\View\View;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    protected static ?string $title = 'Finance dashboard';

    /**
     * pt_BR comments:
     * ->sidebarFullyCollapsibleOnDesktop()
     * ->breadcrumbs(false)
    */
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->sidebarCollapsibleOnDesktop(true)
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile(EditProfile::class)
            ->brandName(config('app.name'))
            ->favicon(asset('image/readme/iconLogoCorporatix120x142.png'))
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->colors([
                'primary' => Color::Fuchsia,
            ])
            ->font('Poppins')
            ->navigationItems([
                NavigationItem::make('Landing page')
                ->url('http://127.0.0.1:8000/')
                ->icon('heroicon-o-globe-asia-australia')
                ->group('Links')
                ->sort(5)
                //->visible(fn(): bool => auth()->user()->can('Dashboard'))
            ])
            ->userMenuItems([
                MenuItem::make()
                ->label('Configurações')
                ->url('')
                ->icon('heroicon-o-cog-6-tooth'),
                'logout' => MenuItem::make()->label('Sair')
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
