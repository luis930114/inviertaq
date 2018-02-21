<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Registro;


class HomeController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registrarse(Request $request)
    {
        var_dump($request);
        // TODO: Hacer esto en una transacción de bd.
        $validator = Validator::make($request->all(),[
            'nit' => 'required',
            'nomEmp' => 'required',
            'direccion' => 'required',
            'pais' => 'required',
        ])->validate();
        $Registro = Registro::create([
            'nit' => $request->nit,
            'nomEmp' => $request->nombre_empresa,
            'direccion' =>$request->direccion,
            'pais' => $request->pais
        ]);
        return view('welcome.blade');
    }

    public function reserva(Request $request){

    }


}
