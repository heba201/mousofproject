<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Namesmeanings_search extends Model
{
    use HasFactory;
    protected $table='namesmeanings_search';
    protected $fillable = [ 'name','namemeaning_id','created_at','search_no','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','name','namemeaning_id','search_no')->orderBy('id','desc');
    }

    public function namemeaning(){

        return $this ->belongsTo('App\Models\Namemeaning','namemeaning_id','id');
    }

}
