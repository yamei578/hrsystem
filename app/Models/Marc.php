<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marc extends Model
{
    //modelo marcaciones de todos
    use HasFactory;
    protected $fillable = [
        'user_id',
        'marcacion_id',
        'fecha_hora_marcacion',
        'latitud',
        'longitud'
    ];

    public function user(){
       return $this->belongsTo('App\Models\User');
       //return $this->hasMany('App\Models\User');
      //  return $this->belongsTo(User::class);
    }

    public function marcacion(){
        return $this->belongsTo('App\Models\ConfigMarc');
    }

}
