<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Container;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shifts';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'hours', 'department_id', 'index'];


//    == Relations ==

    /**
     * Gets the department ( role ) eg. Nurse, Carer, etc...
     *
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('\App\Models\Department');
    }

    /**
     * This gets the Container model
     *
     * @return BelongsToMany
     */
    public function containers()
    {
        return $this->belongsToMany(Container::class, 'container_shift', 'shift_id', 'container_id');
    }

    /**
     * Gets the Employees
     *
     * @return BelongsToMany
     */
    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'shift_employee', 'shift_id', 'employee_id');
    }


    // Methods

    /**
     * Get the location where a shift is assigned
     */
    public function location(): object
    {
        return $this->department()->first()->location;
    }
}
