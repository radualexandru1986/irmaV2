<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftEmployee extends Model
{
    use HasFactory;

    protected $table = 'shift_employee';
    protected $fillable = ['shift_id', 'employee_id'];
}
