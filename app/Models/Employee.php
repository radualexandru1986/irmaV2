<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $fillable = [
        'contract_id',
        'department_id',
        'user_id',
    ];


//    == Relations ==

    /**
     * Gets the user model
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('\App\Models\User', 'user_id');
    }

    /**
     * It gets the contract model
     *
     * @return BelongsTo
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo('\App\Models\Contract', 'contract_id');
    }

    /**
     * It gets the department model
     *
     * @return BelongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo('\App\Models\Department', 'department_id');
    }

    /**
     * @return string
     */
    public function getActiveAttribute(int $value): string
    {
        return $value == 1 ? 'Active' : 'Disabled';
    }

}
