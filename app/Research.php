<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    protected $fillable = ['title', 'description', 'field_of_research'];
    
    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
