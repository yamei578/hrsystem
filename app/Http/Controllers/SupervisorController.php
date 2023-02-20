<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConfigMarc;
use App\Models\ConfigSol;
use App\Models\User;
use App\Models\Marc;
use App\Models\Sols;
use App\Models\Vacante;
use DB;


use Illuminate\Support\Facades\Auth;

class SupervisorController extends Controller
{
    //

    public function indexMarcacionesSupervisor(){
        //retorna vista de sidebar index marcaciones de rol colaboradores
       // $marcaciones = ConfigMarc::all();
        //return view('supervisor.marcaciones.index',['marcaciones'=>$marcaciones]);

       // $user = Auth::user()->marcaciones;
        //$marcaciones = ConfigMarc::all();
       // $marcacionesColaboradores = Marc::all();
        return view('supervisor.marcaciones.index');


    }
    public function indexMarcacionesColaboradores(){
        /*$marcaciones = ConfigMarc::all();
        $marcacionesColaboradores = Marc::all();
        return view('supervisor.marcaciones.colaboradores',
        ['marcaciones'=>$marcaciones,
        'marcacionesColaboradores'=>$marcacionesColaboradores
        ]);*/

        //retorna todas las marcaciones de TODOS por el momento. F

        $users = User::all();
        $marcaciones = ConfigMarc::all();
        $marcacionesColaboradores = Marc::all();
        $query = [];
       // $departmentId = $marcacionesColaboradores->user->department_id;
        return view('supervisor.marcaciones.colaboradores',
        ['marcaciones'=>$marcaciones,
        'marcacionesColaboradores'=>$marcacionesColaboradores,
        'users'=>$users,
        'query'=>$query
        ]);

        //return view('supervisor.marcaciones.colaboradores');
    }

    public function searchMarcaciones(){
//obtener resultados marcaciones de los colaboradores
       
        $users = User::all();

        request()->validate([
            'fromDate'=>['required'],
            'toDate'=>['required','after_or_equal:fromDate'],
        ]);
    
        $marcacionesColaboradores = Marc::all();
        $fromDate = request('fromDate');
        $toDate = request('toDate');
        $user_id = request('user_id');
        $generate = request('generateReport');
       
         
        /*$query = Marc::select()
        ->where('fecha_hora_marcacion', '>=', $fromDate)->where('fecha_hora_marcacion', '<=', $toDate)->where('user_id','=', $users)->get();*/

      // foreach($marcacionesColaboradores as $marcacionColaborador){
       
        //DD($user = DB::table('users')->select()->where('id','=',$user_id));
        //DD($query = DB::table('marcs')->whereDate('fecha_hora_marcacion')->where('user_id','=',$user->id)->get());
      
       $query = DB::table('marcs')->select('users.name','marcs.fecha_hora_marcacion','marcs.latitud','marcs.longitud','config_marcs.name as nombreMarcacion')->whereDate('fecha_hora_marcacion', '>=', $fromDate)->whereDate('fecha_hora_marcacion', '<=', $toDate)->join('users','marcs.user_id','=','users.id')->join('config_marcs','marcs.marcacion_id','=','config_marcs.id')->where('user_id','=',$user_id)->get(); //ESTE
      // }
           
     //   $query = DB::table('marcs')->select()->whereDate('fecha_hora_marcacion', '>=', $fromDate)->where('fecha_hora_marcacion', '<=', $toDate)->get();

 


            return view('supervisor.marcaciones.result',
            [
               
                'users'=>$users,
                'marcacionesColaboradores'=>$marcacionesColaboradores,
                'query'=>$query
               
            ]);
        


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


    public function indexSolicitudesSupervisor(){
       /* $solicitudes = ConfigSol::all();
        return view('supervisor.solicitudes.index',['solicitudes'=>$solicitudes]);*/

        $user = Auth::user()->solicitudes;
        $solicitudes = ConfigSol::all();
        $solicitudesColaboradores = Sols::all();
        return view('supervisor.solicitudes.index',
        ['solicitudes'=>$solicitudes,
        'solicitudesColaboradores'=>$user,
        ]);


    }

    public function indexVacanteInterno(){
        $user = Auth::user()->vacantesinternos;
        $vacantesInternos = Vacante::all();
        return view('supervisor.vacantes.index',
        ['vacantesInternos'=>$vacantesInternos
        ]);

      
       // return view('supervisor.vacantes.index');
    }

    public function indexVacanteInternoVer(){
        return view('supervisor.vacantes.aplicar');
    }

   

    public function indexSolicitudesColaboradores(){

        $users = User::all();
        $solicitudes = ConfigSol::all();
        $solicitudesColaboradores = Sols::all();
        return view('supervisor.solicitudes.colaboradores',
        ['solicitudes'=>$solicitudes,
        'solicitudesColaboradores'=>$solicitudesColaboradores,
        'users'=>$users
        ]);

       // return view('supervisor.solicitudes.colaboradores');
    }

    public function approve($id){


        $sol = Sols::find($id);
        $sol->status=1;
        $sol->save();
        return redirect()->back();

     }
     
     public function decline($id){
  
        $sol = Sols::find($id);
        $sol->status=2;
        $sol->save();

        

        return redirect()->back();
     }

     public function viewSolicitud(Sols $solicitud){
        $sols = ConfigSol::all();

        return view('supervisor.solicitudes.viewsol',
        ['solicitud'=>$solicitud,
        'sols'=>$sols
        ]);
     }


}
