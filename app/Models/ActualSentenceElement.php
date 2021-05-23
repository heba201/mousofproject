<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActualSentenceElement extends Model
{
    use HasFactory;
    protected $table='actual_sentence_elements';
    protected $fillable = ['element_name','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','element_name','admin_id');
    }

    public function verb_parsing(){

        return $this -> hasMany('App\Models\VerbParsing','element_id','id');
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
