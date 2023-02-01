<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];


    public function departments(){
       // one job position has one department 
       return $this->belongsToMany(Department::class);
    }

   public function employees(){
        return $this->belongsTo(Employees::class);
     }

     
     public function users(){
        return $this->belongsTo(User::class);
     }
    
    
}
