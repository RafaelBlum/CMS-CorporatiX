<?php
declare(strict_types=1);

namespace App\Models;

use Filament\Forms\Components\Placeholder;
use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;
use App\Enums\PanelTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use function Filament\Tables\Filters\boolean;

class User extends Authenticatable implements HasAvatar, FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'status',
        'birth',
        'bio',
        'marital_status',
        'academic_education',
        'phone',
        'branch_line',
        'avatar'
    ];

    protected $hidden = ['password', 'remember_token',];

    protected $casts = ['email_verified_at' => 'datetime', 'last_acess' => 'datetime', 'password' => 'hashed', 'status' => 'boolean'];


    /**
     * description: Return all articles
     * ex. $user->articles();
    */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * description: return type role
     * ex. $user->role->name;
     */
    public function role(){
        return $this->belongsTo(Role::class);
    }

    /**
     * description: Verify if role has permissions
     * ex. $user->hasPermission('permission.creat');
     */
    public function hasPermission($permission): bool
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    /**
     * description: Method filament get avatar user into Navbar page
    */
    public function getFilamentAvatarUrl(): ?string
    {
        return asset('storage/' . $this->avatar);
    }

    /**
     * description: Verify permission into panel access dashboard users
     */
    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->role->name === PanelTypeEnum::APP && $panel->getId() === PanelTypeEnum::ADMIN->value) {
            return false;
        }

        return true;
    }
}
