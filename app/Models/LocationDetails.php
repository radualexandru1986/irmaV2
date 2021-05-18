<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LocationDetails extends Model
{
    use HasFactory;

    protected $table = 'location_details';
    protected $fillable = ['location_id', 'address_line1', 'postcode', 'telephone'];

            //    == Relations ==

    /**
     * It gets the Location model
     *
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

}
