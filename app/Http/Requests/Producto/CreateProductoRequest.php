<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'producto_categoria_id' => ['required','integer'],
            'clave' => ['required','string'],
            'descripcion' => ['required', 'string'],
            'clave_sat' => ['required', 'string'],
            'es_servicio' => ['required', 'boolean']
        ];
    }
}
