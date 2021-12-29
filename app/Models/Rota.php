<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Container;
use App\Models\Department;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rota extends Model
{
    use HasFactory;

    protected $table = 'rotas';
    protected $fillable = ['start_date', 'end_date', 'comments', 'department_id'];


//    == Relations ==

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * This gets the all the containers related tot this rota
     *
     * @return HasMany
     */
    public function containers(): HasMany
    {
        return $this->hasMany(Container::class, 'rota_id');
    }

}
