@component('mail::message')
# Hola Invierta en el Quindío,

Este mensaje se ha enviado automaticamente desde la página [https://inviertaenelquindio.com](https://inviertaenelquindio.com) debido a que un cliente ha dejado información personal para una solicitud de reserva.

# Información del cliente:

@component('mail::table')
| Dato                           | Información                                                                                                                                      |
| ------------------------------ |:------------------------------------------------------------------------------------------------------------------------------------------------:|
| <strong>Nombre:</strong>       | {{ $solicitud_reserva->nombre }}                                                                                                                 |
| <strong>Teléfono:</strong>     | {{ $solicitud_reserva->telefono }}                                                                                                               |
| <strong>Correo:</strong>       | {{ $solicitud_reserva->correo }}                                                                                                                 |
| <strong>Solicitud:</strong>    | {!! wordwrap(preg_replace('/_+/', ' ', implode(', ', $solicitud_reserva->solicitud)), 50, html_entity_decode('<br>'), true) !!}                  |
| <strong>Detalles:</strong>     | {!! wordwrap(preg_replace('/[\r\n|\n|\r]+/',html_entity_decode('<br>'), $solicitud_reserva->detalles), 50, html_entity_decode('<br>'), true) !!} |

@endcomponent

Gracias, {{ config('app.name') }}.<br>

@endcomponent
