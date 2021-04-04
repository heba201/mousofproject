<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articlecategory extends Model
{
    use HasFactory;
    protected $table='articlecategories';
    protected $fillable = ['article_category' ,'admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','article_category' ,'admin_id');
    }
    public function articles(){

        return $this -> hasMany('App\Models\Article','article_category','id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
