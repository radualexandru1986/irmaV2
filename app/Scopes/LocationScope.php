<?php
namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class LocationScope implements Scope
{
    private $locationName;
    private $locationId;

    public function __construct($locationName, $locationId)
    {
        $this->locationName = $locationName;
        $this->locationId = $locationId;
    }

    // TODO: Implement apply() method.
    public function apply(Builder $builder, Model $model)
    {
       $builder->where('location_id', $this->locationId);
    }
};
