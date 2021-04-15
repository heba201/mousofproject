<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MojjamSpecialty extends Model
{
    use HasFactory;
    protected $table='mojjam_specialties';
    protected $fillable = ['mojjam_specialty','admin_id','created_at','updated_at'];

    public function scopeSelection($query)
    {

        return $query->select('id','mojjam_specialty','admin_id')
        ->orderBy('id','desc');
    }

    public function mojjams(){

        return $this -> hasMany('App\Models\Mojjam','mojjamspecialty_id','id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
