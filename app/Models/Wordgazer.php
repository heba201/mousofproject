<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wordgazer extends Model
{
    use HasFactory;
    protected $table='word_gazer';
    protected $fillable = [ 'word_gazer','mojjam_id','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','word_gazer','mojjam_id','admin_id');
    }

    public function words(){

        return $this -> hasMany('App\Models\Word','	word_gzer','id');
    }

    public function mojjam()
    {
        return $this->belongsTo('App\Models\Mojjam', 'mojjam_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
