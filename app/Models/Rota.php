<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Container;
use App\Models\Department;

class Rota extends Model
{
    use HasFactory;

    protected $table = 'rotas';
    protected $fillable = ['start_date', 'end_date', 'comments', 'department_id'];



//    == Relations ==
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    /**
     * This gets the all the containers related tot this rota
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function containers()
    {
        return $this->hasMany(Container::class, 'rota_id');
    }

}
