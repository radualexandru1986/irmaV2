<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'id';
    protected $fillable = ['contract_id', 'department_id', 'user_id', 'company_id'];


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

}
