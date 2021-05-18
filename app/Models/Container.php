<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shift;
use App\Models\Employee;

class Container extends Model
{
    use HasFactory;

    protected $table = 'containers';
    protected $primaryKey ='id';
    protected $fillable = ['container_date', 'rota_id'];

//    == Relations ==

    /**
     * Gets the Rota model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rota()
    {
        return $this->belongsTo('\App\Models\Rota', 'rota_id');
    }

    /**
     * Gets the shifts associated with this Container
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function shifts()
    {
        return $this->belongsToMany(Shift::class, 'container_shift', 'container_id', 'shift_id');
    }

}
