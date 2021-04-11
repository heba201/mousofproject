<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;
    protected $table='words';
    protected $fillable = ['word','word_type','admin_id','gzer_type','gzer_weight','weight_indication','other_word_properties','time',
    'word_source','word_indication','word_derivatives','search_no','word_gzer','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','word','word_type','time','admin_id','gzer_type','gzer_weight','gzer_indication','weight_indication','word_source','word_indication','word_derivatives','search_no','word_gzer','other_word_properties');
    }

    public function sentences(){

        return $this -> hasMany('App\Models\Sentence','word_id','id');
    }

    public function meanings(){

        return $this -> hasMany('App\Models\Meaning','word_id','id');
    }
    public function moradfat(){

        return $this -> hasMany('App\Models\Moradfat','word_id','id');
    }
    public function abyaat(){

        return $this -> hasMany('App\Models\Bayt','word_id','id');
    }

    public function word_indications()
    {
        return $this->belongsTo('App\Models\Wordindication', 'word_indication', 'id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
