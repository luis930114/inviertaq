<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SolicitudReservaRequest;
use App\Http\Requests\RegistroEmpresaRequest;
use App\Mail\SolicitudReservaMail;
use App\Mail\RegistroEmpresaMail;
use App\RegistroEmpresa;
use App\SolicitudReserva;
use Validator;
use App;

class HomeController extends Controller
{
    /**
     * Función que permite registrar una empresa en la base de datos para asignarle un código Alfanumerico de 4 caracteres o dígitos.
     *
     * @author Andrés David Montoya Aguirre <admont28@gmail.com>
     * @version 1.0
     * @param  RegistroEmpresaRequest $registroEmpresaRequest Request del registro de la empresa.
     * @return Http                                           Redirecciona hacia / con un flash data.
     */
    public function registro_empresa(RegistroEmpresaRequest $registroEmpresaRequest)
    {
        try {
            $datos_validados = $registroEmpresaRequest->validated();
            $registro_empresa = null;
            while (true) {
                $codigo = $this->generarCodigos(1, 4, true);
                $consultaRegistroEmpresa = RegistroEmpresa::where('reem_codigo', $codigo)->get();
                if($consultaRegistroEmpresa->isEmpty()){
                    $datos_validados['reem_codigo'] = $codigo[0];
                    $registro_empresa = RegistroEmpresa::create($datos_validados);
                    break;
                }
            }
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
            //return new RegistroEmpresaMail($registro_empresa);
            if(App::environment('local')){
                $correos = array_merge($correos_pruebas, $correos_desarrolladores);
                Mail::to($correos)->send(new RegistroEmpresaMail($registro_empresa));
            }elseif(App::environment('production')){
                Mail::to($correos_produccion)->bcc($correos_desarrolladores)->send(new RegistroEmpresaMail($registro_empresa));
            }else{
                echo "Ambiente de aplicación no configurado correctamente.";
                die();
            }
            return redirect('/')->with('result', [
                'type' => 'success',
                'title' => '¡Estupendo!',
                'html' => 'Tu registro de reserva ha sido éxitoso, tu código es: '.$registro_empresa->reem_codigo
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

    /**
     * Función que permite generar códigos alfanuméricos aleatoriamente.
     *
     * @author Andrés David Montoya Aguirre <admont28@gmail.com>
     * @version 1.0
     * @param  integer $cantidad        Cantidad de códigos a generar. default: 3
     * @param  integer $longitud        Longitud de cada código. default: 10
     * @param  boolean $incluye_numeros Si es true, se incluyen números en el código. default: true.
     * @return Array                    Retorna la cantidad de codigos especificados por $cantidad.
     */
    private function generarCodigos($cantidad=3, $longitud=10, $incluye_numeros=true){
        $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if($incluye_numeros)
            $caracteres .= "1234567890";
        $resultado = array();
        $i = 0;
        while($i < $cantidad){
            $tmp = "";
            for($i=0; $i < $longitud; $i++){
                $tmp .= $caracteres[rand(0,strlen($caracteres)-1)];
            }
            if(!in_array($tmp, $resultado)){
                $resultado[] = $tmp;
                $i++;
            }
        }
        return $resultado;
    }

    /**
     * Función que permite crear en base de datos y enviar por correo electrónico una solicitud de reserva.
     *
     * @author Andrés David Montoya Aguirre <admont28@gmail.com>
     * @version 1.0
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
