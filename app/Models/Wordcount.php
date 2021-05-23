<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wordcount extends Model
{
    use HasFactory;
    protected $table='word_count';
    protected $fillable = ['word_count','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','word_count');
    }

    public function words(){

        return $this -> hasMany('App\Models\Word','word_count_id','id');
    }
}
