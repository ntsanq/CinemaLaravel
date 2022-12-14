<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthday',
        'address',
        'avatar',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getGenderNameAttribute(): string
    {
        return ($this->gender === 0) ? 'Male' : 'Female';
    }

    public function getRoleNameAttribute(): string
    {
        if ($this->role === 0) {
            return UserRole::getKey(UserRole::Admin);
        } elseif ($this->role === 1){
            return UserRole::getKey(UserRole::Clerk);
        }
        return UserRole::getKey(UserRole::Customer);
    }
}
