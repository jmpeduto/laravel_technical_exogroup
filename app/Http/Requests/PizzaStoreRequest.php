<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PizzaStoreRequest extends FormRequest
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
            'nombre' => 'required|string|min:3|max:40',
            'descripcion' => 'required|min:3|max:500',
            'ingredientes' => 'required',
            'imagen' => 'required|mimes:png,jpeg,jpg'
        ];

        // $customMessages = [
        //     'required' => ':attribute es requerido.'
        // ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre deb estar completo',
            'descripcion.required' => 'La descripcion debe estar completa',
            'ingredientes.required' => 'Los ingredientes deben estar seleccionados',
            'imagen.required' => 'Debe seleccionar un archivo de imagen para la pizza',
        ];
    }
}
