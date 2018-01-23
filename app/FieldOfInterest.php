<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldOfInterest extends Model
{
    public function user()
    {
        return $this->belongs(User::class);
    }

    public function subFieldOfInterest()
    {
        return $this->hasMany(SubFieldsOfInterest::class);
    }
}
