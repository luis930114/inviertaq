<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitudReservaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|min:5|max:255',
            'telefono' => 'required|numeric|digits_between:7,50',
            'correo' => 'required|email|max:255',
            'solicitud' => 'required|array|min:1',
            'detalles' => 'required|min:5|max:2000'
        ];
    }
}
