<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//using the Entrust UserTrait
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use  Notifiable;
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password','last_name','date_of_birth','gender','login_token','pending','type','is_active',
        'signup_type','image','phone','country_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function likedPosts()
    {
        return $this->morphedByMany('App\Models\Post', 'likeable')->whereDeletedAt(null);
    }
    
    
//    public function ability($roles, $permissions, $options = array()) {
//        
//        parent::ability($roles, $permissions, $options);
//    }
    
}
