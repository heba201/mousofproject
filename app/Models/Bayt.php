<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayt extends Model
{
    use HasFactory;
    protected $table='abyaat';
    protected $fillable = ['bayt','word_id','poet_id','admin_id','created_at','updated_at'];
    public function scopeSelection($query)
    {

        return $query->select('id','bayt','word_id','poet_id','admin_id')->orderBy('id','desc');
    }
    public function poet()
    {
        return $this->belongsTo('App\Models\Poet', 'poet_id', 'id');
    }
    public function word()
    {
        return $this->belongsTo('App\Models\Word', 'word_id', 'id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }

}
