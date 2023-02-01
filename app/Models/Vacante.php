<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
        'job_id',
        'explicacion',
        'status'
    ];

   /*public function user(){
        return $this->belongsTo('App\Models\User');
    }*/

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function job(){
        return $this->belongsTo(Job::class);
    }

    public function users(){
        //for pivot table
       // return $this->belongsToMany(User::class)->withPivot('user_id','vacante_id');
       return $this->belongsToMany('App\Models\User')->withPivot('user_id','vacante_id');
    }


}
