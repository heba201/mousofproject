<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $table='languages';
    protected $fillable = ['language','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','language','admin_id')->orderBy('id','desc');
    }

    public function mojjams(){

        return $this -> hasMany('App\Models\Mojjam','language_id','id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
