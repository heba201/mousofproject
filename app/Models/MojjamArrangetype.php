<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MojjamArrangetype extends Model
{
    use HasFactory;

    protected $table='mojjam_arrangetypes';
    protected $fillable = ['mojjam_arrangetype','admin_id','created_at','updated_at'];

    public function scopeSelection($query)
    {

        return $query->select('id','mojjam_arrangetype','admin_id');

    }

    public function mojjams(){

        return $this -> hasMany('App\Models\Mojjam','mojjamarrangetype_id','id');
    }


    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
