<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table='articles';
    protected $fillable = ['article_category' ,'article_title','article_details','admin_id','article_photo','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','article_category' ,'article_title','article_details','admin_id','article_photo','created_at')
        ->orderBy('id','desc');
    }
    public function getArticle_PhotoAttribute($val)
    {
        return ($val !== null) ? asset('assets/' . $val) : "";

    }
    public function articlecategory()
    {

        return $this->belongsTo('App\Models\Articlecategory', 'article_category', 'id')->orderBy('id','desc');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
