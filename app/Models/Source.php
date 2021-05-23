<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;
    protected $table='source';
    protected $fillable = [ 'source','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','source','admin_id');
    }

    public function words(){

        return $this -> hasMany('App\Models\Word','word_source','id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
