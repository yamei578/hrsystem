<?php

namespace App\Http\Controllers;
use App\Models\ConfigMarc;
use App\Models\ConfigSol;
use Illuminate\Http\Request;
use App\Models\TipoMarcaciones;
use Illuminate\Support\Str;

class HhrrConfigController extends Controller
{
    //



    public function indexMarcaciones(){
        $marcaciones = ConfigMarc::all();
        return view('hhrr.conf.marcaciones',['marcaciones'=>$marcaciones]);
      
    }

    public function indexSolicitudes(){
        $solicitudes = ConfigSol::all();
        return view ('hhrr.conf.solicitudes',['solicitudes'=>$solicitudes]);
    }

  

    


}
