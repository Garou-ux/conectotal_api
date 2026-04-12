<?php

namespace App\Http\Requests\PlantillaProyecto;

use Illuminate\Foundation\Http\FormRequest;

class SavePlantillaProyectoRequest extends FormRequest
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
            'id' => ['nullable', 'integer', 'exists:plantilla_proyectos,id'],
            'supervisor_id' => ['required', 'integer', 'exists:supervisores,id'],
            'catalogo_semana_id' => ['nullable', 'integer', 'exists:catalogo_semanas,id'],
            'proyecto_id' => ['nullable', 'integer', 'exists:proyectos,id'],
            'numero_proyecto' => ['nullable', 'string', 'max:50'],
            'anio' => ['nullable', 'integer', 'min:2024', 'max:2100'],
            'mes' => ['nullable', 'integer', 'min:1', 'max:12'],
            'semana' => ['nullable', 'integer', 'min:1', 'max:53'],
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date'],
            'observaciones' => ['nullable', 'string'],
            'activo' => ['nullable', 'boolean'],
            'detalles' => ['required', 'array', 'min:1'],
            'detalles.*.id' => ['nullable', 'integer', 'exists:plantilla_proyecto_detalles,id'],
            'detalles.*.trabajador_id' => ['nullable', 'integer', 'exists:trabajadores,id'],
            'detalles.*.ficha' => ['nullable', 'string', 'max:50'],
            'detalles.*.nombre_trabajador' => ['nullable', 'string', 'max:255'],
            'detalles.*.bono_puntualidad' => ['nullable', 'boolean'],
            'detalles.*.observaciones' => ['nullable', 'string', 'max:255'],
            'detalles.*.dias' => ['required', 'array', 'min:1', 'max:7'],
            'detalles.*.dias.*.id' => ['nullable', 'integer', 'exists:plantilla_proyecto_detalle_dias,id'],
            'detalles.*.dias.*.dia_semana' => ['required', 'integer', 'min:1', 'max:7'],
            'detalles.*.dias.*.fecha' => ['nullable', 'date'],
            'detalles.*.dias.*.nombre_dia' => ['nullable', 'string', 'max:20'],
            'detalles.*.dias.*.horas_normales' => ['nullable', 'numeric', 'min:0', 'max:24'],
            'detalles.*.dias.*.horas_extra' => ['nullable', 'numeric', 'min:0', 'max:24'],
            'detalles.*.dias.*.proyecto_id' => ['nullable', 'integer', 'exists:proyectos,id'],
            'detalles.*.dias.*.numero_proyecto' => ['nullable', 'string', 'max:50'],
            'detalles.*.dias.*.es_descanso' => ['nullable', 'boolean'],
            'detalles.*.dias.*.observaciones' => ['nullable', 'string', 'max:255'],
        ];
    }
}
