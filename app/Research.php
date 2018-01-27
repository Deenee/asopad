<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    protected $fillable = ['title', 'description'];
    
    public function user()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
