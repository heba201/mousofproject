<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mojjam extends Model
{
    use HasFactory;
    protected $table='mojjams';
    protected $fillable = [ 'mojjam_name','hasgazer','admin_id','author_id','mojjamarrangetype_id','mojjammethod_id','mojjamspecialty_id','example','language_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','mojjam_name','author_id','hasgazer','mojjamarrangetype_id','mojjammethod_id','mojjamspecialty_id','admin_id','example','language_id');
    }

    public function mojjammeanings(){

        return $this -> hasMany('App\Models\Meaning','mojjam_id','id');
    }

    public function words(){

        return $this -> hasMany('App\Models\Word','mojjam_id','id');
    }

    public function gzor(){

        return $this -> hasMany('App\Models\Wordgazer','mojjam_id','id');
    }


    public function moradfaat()
    {
        return $this->hasMany('App\Models\Moradfat', 'mojjam_id', 'id');
    }

    public function modads()
    {
        return $this->hasMany('App\Models\Modad', 'mojjam_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Language', 'language_id', 'id');
    }

    public function mojjamauthor()
    {
        return $this->belongsTo('App\Models\MojjamAuthor', 'author_id', 'id');
    }
    public function mojjamarrangetype()
    {
        return $this->belongsTo('App\Models\MojjamArrangetype', 'mojjamarrangetype_id', 'id');
    }

    public function mojjammethod()
    {
        return $this->belongsTo('App\Models\MojjamMethod', 'mojjammethod_id', 'id');
    }

    public function mojjamspecialty()
    {
        return $this->belongsTo('App\Models\MojjamSpecialty', 'mojjamspecialty_id', 'id');
    }
}
