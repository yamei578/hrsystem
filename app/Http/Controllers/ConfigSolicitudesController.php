<?php

namespace App\Http\Controllers;
use App\Models\ConfigSol;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigSolicitudesController extends Controller
{
    //
    public function storeTipoSolicitudes(){

        request()->validate([
            'name'=>['required'],
            'codigo'=>['required'],
        ]);
    
        ConfigSol::create([
            'name' =>Str::ucfirst(request('name')),
            'codigo' => request('codigo'),
        ]);
    
        session()->flash('solicitudTipo-added', 'Tipo de solicitud agregada: '. request('name'));
    
        return back();
     }
    
     public function edit(ConfigSol $solicitudes){
    
        return view('hhrr.conf.editsolicitudes',
        ['solicitudes'=>$solicitudes
      
        ]);
    
    }
    
    public function update(ConfigSol $solicitudes){
    
        $solicitudes->name = Str::ucfirst(request('name'));
        $solicitudes->codigo = request('codigo');
      
    
        if($solicitudes->isDirty('name') || $solicitudes->isDirty('codigo')){
         // si tenemos algo que hacer update
         session()->flash('solicitudType-updated', 'Tipo de solicitud actualizada: '. request('name'));
         $solicitudes->save();
        } else {
         session()->flash('solicitudType-updated', 'No hay nada que actualizar');
         
        }
    
    
        return back();
    
    
     }
    
     public function destroy(ConfigSol $solicitudes){
    
        $solicitudes->delete();
    
        session()->flash('solicitudTipo-deleted', 'Tipo de solicitud eliminada: '. $solicitudes->name);
    
        return back();
    
    
    }
}
