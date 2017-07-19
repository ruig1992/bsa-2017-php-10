<?php
namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Car
 * @package App\Entity
 */
class Car extends Model
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
        'color',
        'model',
        'registration_number',
        'year',
        'mileage',
        'price',
        'user_id',
    ];

    /**
     * Get the user that owns the car.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
