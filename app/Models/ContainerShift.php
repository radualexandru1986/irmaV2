<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContainerShift extends Model
{
    use HasFactory;
    protected $table = 'container_shift';
    protected $primaryKey = 'id';
    protected $fillable = ['container_id', 'shift_id'];

}
