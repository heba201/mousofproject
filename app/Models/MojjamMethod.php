<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MojjamMethod extends Model
{
    use HasFactory;
    protected $table='mojjam_methods';
    protected $fillable = ['mojjam_method','admin_id','created_at','updated_at'];

    public function scopeSelection($query)
    {

        return $query->select('id','mojjam_method','admin_id');

    }

    public function mojjams(){

        return $this -> hasMany('App\Models\Mojjam','mojjammethod_id','id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
