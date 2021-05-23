<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;
    protected $table='words';
    protected $fillable = ['word_type','admin_id','gzer_type','gzer_weight','weight_indication','other_word_properties','time',
    'word_source','word_indication','word_derivatives','search_no','word_gzer','word_id','mojjam_id','word_count_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','word_type','word_id','mojjam_id','time','admin_id','gzer_type','gzer_weight','weight_indication','word_source','word_indication','word_derivatives','search_no','word_gzer','other_word_properties','word_count_id');
    }


    public function word_indications()
    {
        return $this->belongsTo('App\Models\Wordindication', 'word_indication', 'id');
    }

    public function mojjam()
    {
        return $this->belongsTo('App\Models\Mojjam', 'mojjam_id', 'id');
    }

    public function word()
    {
        return $this->belongsTo('App\Models\Wordname', 'word_id', 'id');
    }

    public function wordgazer()
    {
        return $this->belongsTo('App\Models\Wordgazer', 'word_gzer', 'id');
    }

    public function gazertype()
    {
        return $this->belongsTo('App\Models\Gazertype', 'word_gzer', 'id');
    }
    public function gazerweight()
    {
        return $this->belongsTo('App\Models\Gazerweight', 'gzer_weight', 'id');
    }

    public function weightindication()
    {
        return $this->belongsTo('App\Models\Weightindication', 'weight_indication', 'id');
    }
    public function time()
    {
        return $this->belongsTo('App\Models\Time', 'time', 'id');
    }

    public function source()
    {
        return $this->belongsTo('App\Models\Source', 'word_source', 'id');
    }

    public function word_count()
    {
        return $this->belongsTo('App\Models\Wordcount', 'word_count_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
