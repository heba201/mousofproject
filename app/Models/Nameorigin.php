<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nameorigin extends Model
{
    use HasFactory;
    protected $table='names_origins';
    protected $fillable = [ 'name_origin','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','name_origin','admin_id')->orderBy('id','desc');
    }

    public function namemeanings(){

        return $this -> hasMany('App\Models\Namemeaning','nameorigin_id','id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
