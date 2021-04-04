<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faeda extends Model
{
    use HasFactory;
    protected $table='fawaed';
    protected $fillable = ['faeda','faeda_subject_id','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','faeda','faeda_subject_id','admin_id')->orderBy('id','desc');
    }
    public function fawedsubject()
    {
        return $this->belongsTo('App\Models\Faedasubject','faeda_subject_id','id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
