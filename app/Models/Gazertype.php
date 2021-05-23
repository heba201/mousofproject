<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gazertype extends Model
{
    use HasFactory;
    protected $table='gazer_type';
    protected $fillable = [ 'gazer_type','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','gazer_type','admin_id');
    }

    public function words(){

        return $this -> hasMany('App\Models\Word','gzer_type','id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
