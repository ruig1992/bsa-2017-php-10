<?php
namespace App\Entity;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableInterface;

/**
 * Class User
 * @package App\Entity
 */
class User extends Authenticatable implements AuthenticatableInterface
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'is_active',
        'name',
        'email',
        'password'
    ];

    /**
     * The attributes that should be hidden.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        //'is_admin' => 'boolean',
    ];

    /**
     * Get the cars for the user.
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
