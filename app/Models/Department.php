<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'slug',
    ];

    public function jobs(){
       
        return $this->belongsToMany(Job::class);
    }

    public function employees(){
    
        return $this->belongsTo(Employee::class);
     }

     public function user(){
    
        return $this->belongsTo(User::class);
     }
   
}
