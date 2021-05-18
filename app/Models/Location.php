<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;

    protected $table = 'locations';
    protected $fillable = ['name', 'company_id','manager_id'];

//    == Relations ==

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    /**
     * @todo Must think of a way to get the manager for each location
     */
    public function manager()
    {
        //return the manager
    }

    public function details()
    {
        return $this->hasOne(LocationDetails::class, 'location_id');
    }
}
