<?php

namespace App\Http\Controllers;

use App\Models\ConfigSol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Sols;

class SolicitudesController extends Controller
{
    //
    public function indexPropias(){
        //hhrr solicitudes propias
        $user = Auth::user()->solicitudes;
        $solicitudes = ConfigSol::all();
        $solicitudesColaboradores = Sols::all();
        return view('hhrr.solicitudespropias.index',
        ['solicitudes'=>$solicitudes,
        'solicitudesColaboradores'=>$user,
        ]);
       // return view('hhrr.solicitudespropias.index');
    }

    public function indexColaboradores(){
        //hhrr solicitudes colaboradores

        $users = User::all();
        $solicitudes = ConfigSol::all();
        $solicitudesColaboradores = Sols::all();
        return view('hhrr.solicitudescolaboradores.index',
        ['solicitudes'=>$solicitudes,
        'solicitudesColaboradores'=>$solicitudesColaboradores,
        'users'=>$users
        ]);


        //return view('hhrr.solicitudescolaboradores.index');
    }

    public function solicitudesForm(){
        //formulario para solicitudes: hhrr solicitudes

        //return view('hhrr.solicitudes.index');

        $solicitudes = ConfigSol::all();
        return view('hhrr.solicitudes.index',
        ['solicitudes'=>$solicitudes,
        ]);
    }

    public function storeSolicitudes(){
        $user = Auth::user();
        $solicitud_id = request('solicitud_id');

        if($solicitud_id == 5 || $solicitud_id == 6){
            $user->solicitudes()->create(
                [
                    'user_id'=>$user->id,
                    'solicitud_id'=>request('solicitud_id'),
                    'fecha_desde'=>request('fecha_desde'),
                    'fecha_hasta'=>request('fecha_hasta'),
                    'explicacion'=>request('explicacion'),
                    'fecha_solicitud'=>request('fecha_solicitud'),
                    'monto'=>request('monto'),
                    'cuotas'=>request('cuotas'),
                    'onlyrrhh'=>$user->onlyrrhh = 1
                ]
    
    
            );
        } 
        else {
            $user->solicitudes()->create(
                [
                    'user_id'=>$user->id,
                    'solicitud_id'=>request('solicitud_id'),
                    'fecha_desde'=>request('fecha_desde'),
                    'fecha_hasta'=>request('fecha_hasta'),
                    'explicacion'=>request('explicacion'),
                    'fecha_solicitud'=>request('fecha_solicitud'),
                    'monto'=>request('monto')
                ]
    
    
            );
        }

       
     

        
        
        request()->validate([
            'solicitud_id'=>['required'],
            'fecha_solicitud'=>['required']
        ]);
        session()->flash('request-created', 'Tu solicitud se ha enviado.');
        return back();
    }

    public function showEmployees(){
        //mostrar solicitudes de ese departamento al supervisor
        $users = User::all();
        $solicitudes = ConfigSol::all();
        $solicitudesColaboradores = Sols::all();
    
       
        return view('supervisor.solicitudes.colaboradores',
        ['solicitudes'=>$solicitudes,
        'solicitudesColaboradores'=>$solicitudesColaboradores,
        'users'=>$users,
        'only1'=>$only1
        ]);
    }

    public function approve($id){
       //aprobar solicitud RRHH

        $sol = Sols::find($id);
        $sol->statusrrhh=1;
        $sol->save();
        return redirect()->back();

     }
     
     public function decline($id){
      //aprobar solicitud RRHH
        $sol = Sols::find($id);
        $sol->statusrrhh=2;
        $sol->save();

        

        return redirect()->back();
     }

     public function rrhhViewSol(Sols $solicitud){
        $sols = ConfigSol::all();

        return view('hhrr.solicitudescolaboradores.rrhhviewsols',
        ['solicitud'=>$solicitud,
        'sols'=>$sols
        ]);
     }

}
