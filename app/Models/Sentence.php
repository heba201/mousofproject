<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    use HasFactory;
    protected $table='sentences';
    protected $fillable = ['word_id' ,'word_sentence','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','word_id','word_sentence','admin_id');
    }

    public function word()
    {
        return $this->belongsTo('App\Models\Wordname', 'word_id', 'id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
