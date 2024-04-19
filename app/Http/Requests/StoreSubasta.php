<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubasta extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //Venía en "false" por defecto, lo cambié a "true" para que pase al siguiente método.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'producto_id' => 'required',
            'name' => 'required|min:3',
            'cantidad' => 'required|numeric|gt:0',
            'puja' => 'required|numeric',
            'precio' => 'required|numeric|gt:puja',
            'fecha_limite' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'producto_id.required' => 'La cantidad que has seleccionado es mayor a la que tienes.',
            'name.required' => 'El nombre es obligatorio.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'puja.required' => 'La puja es obligatoria.',
            'precio.gt' => 'El precio debe ser mayor que la puja.',
            'fecha_limite.required' => 'La fecha límite es obligatoria.'
        ];
    }
}
