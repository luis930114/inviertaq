<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registro;
use Validator;

class HomeController extends Controller
{
    public function getSolicitud(){
        return view('welcome');
    }
    public function enviarSolicitud(Request $request)
    {
        //echo "esto si paso por aqui";
        //var_dump($request);
        $validator =  Validator::make($request->all(),[
            'nit' => 'required',
            'nomEmp' => 'required',
            'direccion' => 'required',
            'pais' => 'required',
            ])->validate();
        $registro = Registro::create([
            'nit' => $request->nit,
            'nombre_empresa'=>$request->nomEmp,
            'direccion' => $request->direccion,
            'pais' => $request->pais,
        ]);
        return view('welcome')
            ->with('estado', true)
            ->with('codigo_registro', $registro->codigo_registro);

    }
    public function getEnviarsolicitud(){
        return  view('welcome')->with('estado', true);
    }
}
