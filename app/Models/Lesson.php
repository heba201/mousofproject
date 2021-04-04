<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $table='lessons';
    protected $fillable = ['lessoncategory_id' ,'lesson_title','lesson_details','admin_id','lesson_photo','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','lessoncategory_id' ,'lesson_title','lesson_details','admin_id','lesson_photo');
    }
    public function getLesson_PhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";

    }
    public function lessoncategory()
    {

        return $this->belongsTo('App\Models\Lessoncategory', 'lessoncategory_id', 'id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
