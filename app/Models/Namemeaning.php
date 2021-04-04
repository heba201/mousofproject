<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Namemeaning extends Model
{
    use HasFactory;
    protected $table='names_meanings';
    protected $fillable = [ 'name','name_meaning','nameorigin_id','name_type','admin_id','created_at','updated_at','search_no'];
    public function scopeSelection($query)
    {

        return $query->select('id','name','name_meaning','nameorigin_id','name_type','admin_id','search_no')->orderBy('id','desc');
    }

    public function nameorigin(){

        return $this ->belongsTo('App\Models\Nameorigin','nameorigin_id','id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }

    public function namemeaning_searches(){

        return $this -> hasMany('App\Models\Namesmeanings_search','namemeaning_id','id');
    }
}
