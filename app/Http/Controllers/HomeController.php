<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SolicitudReservaRequest;
use App\Mail\SolicitudReservaMail;
use App\Registro;
use App\SolicitudReserva;
use Validator;
use App;

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

    /**
     * Función que permite crear en base de datos y enviar por correo electrónico una solicitud de reserva.
     *
     * @param  SolicitudReservaRequest $solicitudReservaRequest Request de la solicitud de reserva.
     * @return Http                                             Redirecciona hacia / con un flash data.
     */
    public function solicitud_reserva(SolicitudReservaRequest $solicitudReservaRequest)
    {
        try {
            $solicitud_reserva = SolicitudReserva::create($solicitudReservaRequest->validated());

            $correos_produccion = array(
                env('EMAIL_ADDRESS_INVIERTA_EN_EL_QUINDIO_PRODUCTION'),
                env('EMAIL_ADDRESS_CEO_PABLO_PRADA')
            );
            $correos_pruebas = array(
                env('EMAIL_ADDRESS_INVIERTA_EN_EL_QUINDIO_DEVELOPMENT')
            );
            $correos_desarrolladores = array(
                env('EMAIL_ADDRESS_DEVELOPER_ANDRES_MONTOYA'),
                env('EMAIL_ADDRESS_DEVELOPER_FELIPE_HERNANDEZ')
            );
            //return new SolicitudReservaMail($solicitud_reserva);
            if(App::environment('local')){
                $correos = array_merge($correos_pruebas, $correos_desarrolladores);
                Mail::to($correos)->send(new SolicitudReservaMail($solicitud_reserva));
            }elseif(App::environment('production')){
                Mail::to($correos_produccion)->bcc($correos_desarrolladores)->send(new SolicitudReservaMail($solicitud_reserva));
            }else{
                echo "Ambiente de aplicación no configurado correctamente.";
                die();
            }
            return redirect('/')->with('result', [
                'type' => 'success',
                'title' => '¡Estupendo!',
                'html' => 'Tu solicitud de reserva ha sido enviada con éxito a nuestro equipo de reservas. Pronto nos comunicaremos contigo para ultimar detalles. Hasta pronto.'
                ]
            );
        } catch (\Exception $e) {
            return redirect('/')->with('result', [
                'type' => 'error',
                'title' => '¡Lo sentimos!',
                'html' => 'Ha ocurrido un error inesperado, por favor inténtalo de nuevo más tarde.'
                ]
            );
        }
    }
}
