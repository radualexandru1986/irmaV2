<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'departments';
    protected $fillable = ['name', 'description'];

//    == Relations ==

    /**
     * Accessing the Employee Model
     *
     * @return HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany('\App\Models\Employee', 'department_id');
    }

    /**
     * Accessing the Shift Model
     *
     * @return HasMany
     */
    public function shifts(): HasMany
    {
        return $this->hasMany('\App\Models\Shift', 'department_id');
    }

    /**
     * @return BelongsTo
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
