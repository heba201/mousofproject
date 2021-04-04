<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;
    protected $table='roles';
    protected $fillable = [
        'name',
        'role_name',
        'created_at',
        'updated_at'
    ];

    public function scopeSelection($query)
    {

        return $query->select('id','role_name','created_at')
        ->orderBy('id','desc');
    }

    public function admin(){
        return $this->hasOne('App\Models\Admin', 'role_id', 'id');
    }

}
