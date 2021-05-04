<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table='user_addresses';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'comments', 'postcode', 'building_name', 'street', 'number'];

//    ==  relations ==

    /**
     * Each address belongs to a user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

}
