<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mojjam extends Model
{
    use HasFactory;
    protected $table='mojjams';
    protected $fillable = [ 'mojjam_name','admin_id','author_id','mojjamarrangetype_id','mojjammethod_id','mojjamspecialty_id','example','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','mojjam_name','author_id','mojjamarrangetype_id','mojjammethod_id','mojjamspecialty_id','admin_id','example');
    }

    public function mojjammeanings(){

        return $this -> hasMany('App\Models\Meaning','mojjam_id','id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }

    public function mojjamauthor()
    {
        return $this->belongsTo('App\Models\MojjamAuthor', 'author_id', 'id');
    }
}
