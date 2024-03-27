<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Placeholder;

/**
 * Custom field classes: Profile user in App\Filament\Pages\Auth;
 * ref: https://filamentphp.com/docs/3.x/forms/fields/custom#custom-field-classes
*/
class HeaderProfileUser extends Placeholder
{
    protected string $view = 'forms.components.header-profile-user';
}
