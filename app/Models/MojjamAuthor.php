<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MojjamAuthor extends Model
{
    use HasFactory;
    protected $table='mojjams_authors';
    protected $fillable = ['author_name' ,'about_author','admin_id','created_at','updated_at'];

    public function scopeSelection($query)
    {

        return $query->select('id','author_name' ,'about_author','admin_id')
        ->orderBy('id','desc');
    }

    public function mojjams(){

        return $this -> hasMany('App\Models\Mojjam','author_id','id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
