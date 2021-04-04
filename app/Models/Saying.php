<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saying extends Model
{
    use HasFactory;
    protected $table='sayings';
    protected $fillable = [ 'saying','character_id','admin_id','created_at','updated_at','wisdomsayingsubject_id','saying_photo','saying_tag'];
    public function scopeSelection($query)
    {

        return $query->select('id','saying','character_id','admin_id','wisdomsayingsubject_id','saying_tag','saying_photo')->orderBy('id','desc');
    }
    public function character()
    {
        return $this->belongsTo('App\Models\Character', 'character_id', 'id');
    }
    public function saysubject(){

        return $this ->belongsTo('App\Models\WisdomSayingsubject','wisdomsayingsubject_id','id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
