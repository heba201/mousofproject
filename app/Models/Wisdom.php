<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisdom extends Model
{
    use HasFactory;
    protected $table='wisdoms';
    protected $fillable = ['wisdom' ,'wisdom_type','admin_id','created_at','updated_at','wisdomsayingsubject_id','character_id','wisdom_photo','wisdom_tag'];
    public function scopeSelection($query)
    {

        return $query->select('id','wisdom' ,'wisdom_type','admin_id','character_id','wisdomsayingsubject_id','wisdom_photo','wisdom_tag')->orderBy('id','desc');
    }

    public function wisdomsubject(){

        return $this ->belongsTo('App\Models\WisdomSayingsubject','wisdomsayingsubject_id','id');
    }

    public function character(){

        return $this ->belongsTo('App\Models\Character','character_id','id');
    }
    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admin_id', 'id');
    }
}
