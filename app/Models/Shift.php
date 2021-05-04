<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Container;
use App\Models\Employee;

class Shift extends Model
{
    use HasFactory;

    protected $table = 'shifts';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'hours', 'department_id', 'location_id'];


//    == Relations ==

    /**
     * Gets the department ( role ) eg. Nurse, Carer, etc...
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo('\App\Models\Department');
    }

    /**
     * This gets the Container model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function container()
    {
        return $this->belongsToMany(Container::class, 'container_shift', 'shift_id', 'container_id');
    }

    /**
     * Gets the Employees
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'shift_employee', 'shift_id', 'employee_id');
    }
}
