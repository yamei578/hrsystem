<?php

namespace App\Http\Controllers;
use App\Models\ConfigMarc;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigMarcController extends Controller
{
    //

    public function indexMarcaciones(){
        $marcaciones = ConfigMarc::all();
        return view('hhrr.conf.marcaciones',['marcaciones'=>$marcaciones]);
      
    }

public function storeTipoMarcaciones(){

    request()->validate([
        'name'=>['required'],
        'codigo'=>['required'],
    ]);

    ConfigMarc::create([
        'name' =>Str::ucfirst(request('name')),
        'codigo' => request('codigo'),
    ]);

    session()->flash('marcacionType-added', 'Tipo de marcación agregada: '. request('name'));

    return back();
 }

 public function edit(ConfigMarc $marcaciones){

    return view('hhrr.conf.editmarcaciones',
    ['marcaciones'=>$marcaciones
  
    ]);

}

public function update(ConfigMarc $marcaciones){

    $marcaciones->name = Str::ucfirst(request('name'));
    $marcaciones->codigo = request('codigo');
  

    if($marcaciones->isDirty('name') || $marcaciones->isDirty('codigo')){
     // si tenemos algo que hacer update
     session()->flash('marcacionType-updated', 'Tipo de marcación actualizada: '. request('name'));
     $marcaciones->save();
    } else {
     session()->flash('marcacionType-updated', 'No hay nada que actualizar');
     
    }

    

    return redirect()->route('marcaciones.index');


 }

 public function destroy(ConfigMarc $marcaciones){

    $marcaciones->delete();

    session()->flash('marcacionTipo-deleted', 'Tipo de marcación eliminada: '. $marcaciones->name);

    return back();


}

}
