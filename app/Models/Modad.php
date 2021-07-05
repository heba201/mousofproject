<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modad extends Model
{
    use HasFactory;
    protected $table='modad';
    protected $fillable = ['word_id','modad','mojjam_id','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','word_id','modad','mojjam_id','admin_id')->orderBy('id','desc');
    }
    public function word()
    {
        return $this->belongsTo('App\Models\Wordname', 'word_id', 'id');
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
