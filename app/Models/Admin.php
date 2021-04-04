<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory , Notifiable;
    protected $table='admins';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'created_at',
        'updated_at'
    ];
    public function scopeSelection($query)
    {

        return $query->select('id','name','email','password','role_id')->orderBy('id','desc');
    }
    public function role(){
        return $this->belongsTo('App\Models\role', 'role_id', 'id');
    }
    public function meanings(){

        return $this -> hasMany('App\Models\Meaning','admin_id','id');
    }
    public function articles(){

        return $this -> hasMany('App\Models\Article','admin_id','id');
    }
    public function articlecategories(){

        return $this -> hasMany('App\Models\Articlecategory','admin_id','id');
    }
    public function abyaat(){

        return $this -> hasMany('App\Models\Bayt','admin_id','id');
    }
    public function charactrs(){

        return $this -> hasMany('App\Models\Character','admin_id','id');
    }
    public function fawaed(){

        return $this -> hasMany('App\Models\Faeda','admin_id','id');
    }
    public function fawaedsubjects(){

        return $this -> hasMany('App\Models\Faedasubject','admin_id','id');
    }
    public function lessons(){

        return $this -> hasMany('App\Models\Lesson','admin_id','id');
    }
    public function lessoncategories(){

        return $this -> hasMany('App\Models\Lessoncategory','admin_id','id');
    }

    public function mojjams(){

        return $this -> hasMany('App\Models\Mojjam','admin_id','id');
    }
    public function moradfat(){

        return $this -> hasMany('App\Models\Moradfat','admin_id','id');
    }
    public function namemeanings(){

        return $this -> hasMany('App\Models\Namemeaning','admin_id','id');
    }
    public function nameorigins(){

        return $this -> hasMany('App\Models\Nameorigin','admin_id','id');
    }

    public function poets(){

        return $this -> hasMany('App\Models\Poet','admin_id','id');
    }
    public function sayings(){

        return $this -> hasMany('App\Models\Saying','admin_id','id');
    }
    public function sentences(){

        return $this -> hasMany('App\Models\Sentence','admin_id','id');
    }
    public function wisdoms(){

        return $this -> hasMany('App\Models\Wisdom','admin_id','id');
    }
    public function wisdomsayingsubjects(){

        return $this -> hasMany('App\Models\WisdomSayingsubject','admin_id','id');
    }
    public function words(){

        return $this -> hasMany('App\Models\Word','admin_id','id');
    }
}
