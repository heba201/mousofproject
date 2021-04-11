<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wordindication extends Model
{
    use HasFactory;
    protected $table='word_indication';
    protected $fillable = ['word_indication' ,'admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','word_indication' ,'admin_id');
    }

    public function words(){

        return $this -> hasMany('App\Models\Word','word_indication','id');
    }


}
