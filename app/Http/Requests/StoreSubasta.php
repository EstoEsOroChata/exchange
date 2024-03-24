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
            'nombre' => 'required|min:3',
            'cantidad' => 'required|numeric',
            'puja' => 'required|numeric',
            'precio' => 'required|numeric|gt:puja',
            'fecha_limite' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'cantidad.required' => 'La cantidad es obligatoria',
            'puja.required' => 'La puja es obligatoria',
            'precio.gt' => 'El precio debe ser mayor que la puja.',
            'fecha_limite.required' => 'La fecha límite es obligatoria'
        ];
    }
}
