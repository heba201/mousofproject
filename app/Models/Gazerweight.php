<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gazerweight extends Model
{
    use HasFactory;
    protected $table='gazer_weight';
    protected $fillable = [ 'gazer_weight','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','gazer_weight','admin_id');
    }

    public function words(){

        return $this -> hasMany('App\Models\Word','gzer_weight','id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
