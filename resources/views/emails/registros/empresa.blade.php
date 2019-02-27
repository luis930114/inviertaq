@component('mail::message')
# Hola Invierta en el Quindío,

Este mensaje se ha enviado automaticamente desde la página [https://inviertaenelquindio.com](https://inviertaenelquindio.com) debido a que una nueva empresa se ha registrado.

# Información de la empresa:

@component('mail::table')
| Dato                                  | Información                                                                                                                                       |
| ------------------------------------- |:-------------------------------------------------------------------------------------------------------------------------------------------------:|
| <strong>NIT:</strong>                 | {{ $registro_empresa->reem_nit }}                                                                                                                  |
| <strong>Nombre:</strong>              | {{ $registro_empresa->reem_nombre }}                                                                                                                |
| <strong>Teléfono:</strong>            | {{ $registro_empresa->reem_telefono }}                                                                                                                  |
| <strong>Dirección:</strong>           | {!! wordwrap(preg_replace('/_+/', ' ', $registro_empresa->reem_direccion), 50, html_entity_decode('<br>'), true) !!}                   |
| <strong>Correo:</strong>              | {{ $registro_empresa->reem_correo }}                                                                                                           |
| <strong>Código:</strong>              | {{ $registro_empresa->reem_codigo }}                                                                                                            |
| <strong>Fecha de registro:</strong>   | {{ $registro_empresa->created_at }}   |

@endcomponent

Gracias, {{ config('app.name') }}.<br>

@endcomponent
