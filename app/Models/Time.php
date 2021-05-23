<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    protected $table='time';
    protected $fillable = [ 'time','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','time','admin_id');
    }

    public function words(){

        return $this -> hasMany('App\Models\Word','time','id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
