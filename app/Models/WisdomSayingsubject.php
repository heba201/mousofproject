<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WisdomSayingsubject extends Model
{
    use HasFactory;
    protected $table='wisdom_sayingsubjects';
    protected $fillable = ['subject' ,'admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','subject' ,'admin_id','created_at')
        ->orderBy('id','desc');
    }
    public function sayings(){

        return $this -> hasMany('App\Models\Saying','wisdomsayingsubject_id','id');
    }
    public function wisdoms(){

        return $this -> hasMany('App\Models\Wisdom','wisdomsayingsubject_id','id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
