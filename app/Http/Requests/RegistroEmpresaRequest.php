<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroEmpresaRequest extends FormRequest
{
    /**
     * The key to be used for the view error bag.
     *
     * Al colocar este atributo se puede acceder a la variable de errores así:
     * $errors->registroempresa->any()
     * $errors->registroempresa->all()
     *
     * @var string
     */
    protected $errorBag = 'registroempresa';

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
            'reem_nit' => 'required',
            'reem_nombre' => 'required|min:5|max:255',
            'reem_telefono' => 'required|numeric|digits_between:7,50',
            'reem_direccion' => 'required|min:5|max:255',
            'reem_correo' => 'required|email|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'reem_nit.required' => 'El NIT de la empresa es requerido.',
            'reem_nombre.required'  => 'El nombre de la empresa es requerido.',
            'reem_nombre.min'  => 'El nombre de la empresa debe ser de mínimo :min caracteres.',
            'reem_nombre.max'  => 'El nombre de la empresa debe ser de máximo :max caracteres.',
            'reem_telefono.required'  => 'El teléfono de la empresa es requerido.',
            'reem_telefono.numeric'  => 'El teléfono de la empresa debe ser un número.',
            'reem_telefono.digits_between'  => 'El teléfono de la empresa debe tener entre :min y :max dígitos.',
            'reem_direccion.required'  => 'La dirección de la empresa es requerida.',
            'reem_direccion.min'  => 'La dirección de la empresa debe ser de mínimo :min caracteres.',
            'reem_direccion.max'  => 'La dirección de la empresa debe ser de máximo :max caracteres.',
            'reem_correo.required'  => 'El correo de la empresa es requerido.',
            'reem_correo.email'  => 'El correo de la empresa debe tener un formato de correo electrónico válido.',
            'reem_correo.max'  => 'El correo de la empresa debe ser de máximo :max caracteres.',
        ];
    }
}
