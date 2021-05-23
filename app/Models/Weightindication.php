<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weightindication extends Model
{
    use HasFactory;

    protected $table='weight_indication';
    protected $fillable = [ 'weight_indication','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','weight_indication','admin_id');
    }

    public function words(){

        return $this -> hasMany('App\Models\Word','weight_indication','id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
