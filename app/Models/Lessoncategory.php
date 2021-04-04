<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lessoncategory extends Model
{
    use HasFactory;
    protected $table='lessoncategories';
    protected $fillable = ['lesson_category' ,'admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','lesson_category' ,'admin_id');
    }
    public function lessons(){

        return $this -> hasMany('App\Models\Lesson','lessoncategory_id','id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
