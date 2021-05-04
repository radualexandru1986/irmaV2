<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $fillable = ['name'];

//    == Relations ==

    /**
     * Gets the Location model
     *
     * @return HasMany
     */
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class, 'company_id');
    }

    /**
     * Gets the employee model
     *
     * @return HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class, 'company_id');
    }
}
