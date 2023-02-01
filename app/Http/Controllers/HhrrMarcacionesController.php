<?php

namespace App\Http\Controllers;
use App\Models\ConfigMarc;
use App\Models\TipoMarcacion;
use Illuminate\Support\Str;
use App\Models\ConfigSol;
use App\Models\Marc;
use App\Models\User;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HhrrMarcacionesController extends Controller
{
    //INICIO MARCACIONES HHRR PROPIAS!


    public function indexPropias(){

       
        //return view('hhrr.conf.marcaciones',['marcaciones'=>$marcaciones]);
        $user = Auth::user()->marcaciones;
        $marcaciones = ConfigMarc::all();
        $marcacionesColaboradores = Marc::all();
        return view('hhrr.marcaciones.propias',
        ['marcaciones'=>$marcaciones,
        'marcacionesColaboradores'=>$user
        ]);

        //return view('hhrr.marcaciones.propias',['marcaciones'=>$marcaciones]);
    }


    public function storeMarcacionesPropias(){

        $user = Auth::user();
        $user->marcaciones()->create(
            [
                'user_id'=>$user->id,
                'marcacion_id'=>request('marcacion_id'),
                'fecha_hora_marcacion'=>request('fecha_hora_marcacion')
            ]


        );

        request()->validate([
            'marcacion_id'=>['required'],
            'fecha_hora_marcacion'=>['required']
        ]);
 
        return back();
    }



    public function indexColaboradores(){
      //  $user = Auth::user()->marcaciones;
        $users = User::all();
        $marcaciones = ConfigMarc::all();
        $marcacionesColaboradores = Marc::all();
        return view('hhrr.marcaciones.colaboradores',
        ['marcaciones'=>$marcaciones,
        'marcacionesColaboradores'=>$marcacionesColaboradores,
        'users'=>$users
        ]);
       // return view('hhrr.marcaciones.colaboradores');
    }

    public function search(){
      
      /*  $dateFrom = request('dateFrom');
        $dateTo = request('dateTo');
        $dates = Marc::where('user_id','=',request()->user_id)
         ->whereBetween('datetime',[$dateFrom,$dateTo])
         ->get();

         echo  $dates;*/

         $users = User::all();

         request()->validate([
            'dateFrom'=>['required'],
            'dateTo'=>['required','after_or_equal:dateFrom'],
        ]);
       
       
         $marcacionesColaboradores = Marc::all();
         $fromDate = request('dateFrom');
         $toDate = request('dateTo');
         $user_id = request('user_id');
        
         
     
          
         /*$query = Marc::select()
         ->where('fecha_hora_marcacion', '>=', $fromDate)->where('fecha_hora_marcacion', '<=', $toDate)->where('user_id','=', $users)->get();*/
 
       // foreach($marcacionesColaboradores as $marcacionColaborador){
        
         //DD($user = DB::table('users')->select()->where('id','=',$user_id));
         //DD($query = DB::table('marcs')->whereDate('fecha_hora_marcacion')->where('user_id','=',$user->id)->get());
        $query = DB::table('marcs')->select('users.name','marcs.fecha_hora_marcacion','config_marcs.name as nombreMarcacion')->whereDate('fecha_hora_marcacion', '>=', $fromDate)->whereDate('fecha_hora_marcacion', '<=', $toDate)->join('users','marcs.user_id','=','users.id')->join('config_marcs','marcs.marcacion_id','=','config_marcs.id')->where('user_id','=',$user_id)->get(); //ESTE
       // }
            
      //   $query = DB::table('marcs')->select()->whereDate('fecha_hora_marcacion', '>=', $fromDate)->where('fecha_hora_marcacion', '<=', $toDate)->get();
 
         return view('hhrr.marcaciones.result',
     [
        
         'users'=>$users,
         'marcacionesColaboradores'=>$marcacionesColaboradores,
         'query'=>$query
        
     ]);
    }



   
}
