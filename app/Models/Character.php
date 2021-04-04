<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;
    protected $table='characters';
    protected $fillable = ['character_name' ,'about_character','character_type','admin_id','character_photo','created_at','updated_at'];

    public function scopeSelection($query)
    {

        return $query->select('id','character_name' ,'about_character','admin_id','character_type','character_photo')
        ->orderBy('id','desc');
    }
    public function sayings(){

        return $this -> hasMany('App\Models\Saying','character_id','id');
    }

    public function wisdoms(){

        return $this -> hasMany('App\Models\Wisdom','character_id','id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
