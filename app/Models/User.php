<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//use App\Models\Location;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'telephone',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * @return HasMany
     *
     * One user can have multiple addresses registered
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'user_id');
    }

    /**
     * Access the employee details
     *
     * @return HasOne
     */
    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class, 'user_id');
    }


//    /**
//     * @return BelongsTo
//     */
//    public function location(): BelongsTo
//    {
//        return $this->belongsTo(Location::class, 'location_id');
//    }


    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Gets the string role.
     */
    public function getRole()
    {
        return $this->role->name;
    }


    /**
     * Global scope.
     */
    protected static function booted()
    {
        //static::addGlobalScope(new LocationScope('Dussindalepark', 1));
    }


    //methods

    /**
     * Returns tru if the model is Admin
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role->name === 'admin';
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
