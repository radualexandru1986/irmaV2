<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $table = 'contracts';
    protected $primaryKey = 'id';
    protected $fillable = ['hours','location_id'];


//    == Relations ==

    /**
     * Gets the Employee model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employees()
    {
        return $this->belongsToMany('\App\Models\Employee', 'contract_id');
    }
}
