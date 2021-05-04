<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'departments';
    protected $fillable = ['name', 'description', 'location_id'];

//    == Relations ==

    /**
     * Accessing the Employee Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employees()
    {
        return $this->hasMany('\App\Models\Employee', 'department_id');
    }

    /**
     * Accessing the Shift Model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shifts()
    {
        return $this->hasMany('\App\Models\Shift', 'department_id');
    }
}
