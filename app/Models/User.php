<?php
declare(strict_types=1);

namespace App\Models;

use Filament\Forms\Components\Placeholder;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use function Filament\Tables\Filters\boolean;

class User extends Authenticatable implements HasAvatar
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


    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission)
    {
        return $this->role->permissions()->where('slug', $permission)->first() ? true : false;
    }

    /**
     * Method filament get avatar user into navbar page
    */
    public function getFilamentAvatarUrl(): ?string
    {
        return asset('storage/' . $this->avatar);
    }

}
