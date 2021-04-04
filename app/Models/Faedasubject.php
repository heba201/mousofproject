<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faedasubject extends Model
{
    use HasFactory;
    protected $table='faedasubjects';
    protected $fillable = ['faeda_subject','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','faeda_subject','admin_id')->orderBy('id','desc');
    }
    public function fawed(){

        return $this -> hasMany('App\Models\Faeda','faeda_subject_id','id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
