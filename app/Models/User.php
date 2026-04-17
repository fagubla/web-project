<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }


    public function friends()
    {
        return $this->friendsFrom()->merge($this->friendsTo());
    }
    public function friendsFrom()
    {
        // Iniciado
        return $this->belongsToMany(User::class, 'friends', 'from_id', 'to_id')->wherePivot('accepted', true);
    }

    public function friendsTo()
    {
        // Aceptado
        return $this->belongsToMany(User::class, 'friends', 'to_id', 'from_id')->wherePivot('accepted', true);
    }

    public function pendingFrom()
    {
        // Pendiente
        return $this->belongsToMany(User::class, 'friends', 'from_id', 'to_id')->wherePivot('accepted', false);
    }

    public function pendingTo()
    {
        // Pendiente
        return $this->belongsToMany(User::class, 'friends', 'to_id', 'from_id')->wherePivot('accepted', false);
    }

    public function isRelated(User $user)
    {
        if (auth()->user()->id === $user->id) {
            return true;
        }
        // Or from_id
        return $this->belongsToMany(User::class, 'friends', 'from_id', 'to_id')->where('to_id')->exists();
    }
}
