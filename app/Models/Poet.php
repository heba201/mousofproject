<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poet extends Model
{
    use HasFactory;
    protected $table='poets';
    protected $fillable = ['poet_name','poet_era','admin_id','created_at','updated_at'];

    public function scopeSelection($query)
    {

        return $query->select('id','poet_name','poet_era','admin_id')
        ->orderBy('id','desc');
    }
    public function abyaat(){

        return $this -> hasMany('App\Models\Bayt','poet_id','id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
