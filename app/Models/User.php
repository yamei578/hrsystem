<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'avatar',
        'email',
        'employee_number',
        'password',
        'department_id',
        'job_id',
        'salario',
        'fecha_ingreso',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    public function getAvatarAttribute($value){
        //return asset($value);
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
          }
            return asset('storage/' . $value);
    }


    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function userHasRole($role_name){
        //check the users roles
        foreach($this->roles as $role){
            if(Str::lower($role_name) == Str::lower($role->name)){
                return true;
            }
        }
        return false;
    }

    public function marcaciones(){
        
        return $this->hasMany('App\Models\Marc');
      

    }
    public function solicitudes(){
        
        return $this->hasMany('App\Models\Sols');
      

    }

    public function vacantesinternos(){
        
        return $this->hasMany('App\Models\Vacante');
      

    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function job(){
        return $this->belongsTo(Job::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

 /*   public function vacantes(){
        //for pivot table
        return $this->belongsToMany(Vacante::class);
    }*/

    public function vacantes(){
        //for pivot table
       // return $this->belongsToMany(Vacante::class)->withPivot('user_id','vacante_id');
       return $this->belongsToMany('App\Models\Vacante')->withPivot('user_id','vacante_id');

    }

    public function payslips(){
        
        return $this->hasMany('App\Models\Payslip');
      

    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    

}
