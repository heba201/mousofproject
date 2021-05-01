<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wordname extends Model
{
    use HasFactory;
    protected $table='wordnames';
    protected $fillable = ['word','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','word','admin_id');
    }

    public function words(){

        return $this -> hasMany('App\Models\Word','word_id','id');
    }
    public function sentences(){

        return $this -> hasMany('App\Models\Sentence','word_id','id');
    }

    public function meanings(){

        return $this -> hasMany('App\Models\Meaning','word_id','id');
    }

    public function moradfat(){

        return $this -> hasMany('App\Models\Moradfat','word_id','id');
    }


    public function abyaat(){

        return $this -> hasMany('App\Models\Bayt','word_id','id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
