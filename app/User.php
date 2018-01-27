<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Http\Controllers\Traits\ReviewerTrait;
use App\Http\Controllers\Traits\ResearcherTrait;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, LaratrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'phone_number', 'email', 'email_token', 'email_status', 'institution_id', 'current_location', 'address_of_institution', 'department_id', 'field_of_study', 'password', 'provider', 'provider_id', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'provider', 'provider_id', 'email_token'
    ];

    public function research()
    {
        return $this->belongsToMany(Research::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
