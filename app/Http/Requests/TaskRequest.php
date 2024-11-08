<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100', Rule::unique('tasks', 'name')->ignore($this->task)],
            'description' => ['required', 'string','max:500'],
            'completed' => ['boolean'],
        ];
    }

    /**
     *
     * @return array<string, string>
     */

    public function messages():array
    {
        return[
            'name.required' =>'El campo nombre es obligatorio',
            'name.string' =>'El campo nombre debe ser una cadena de texto',
            'name.max' => 'El campo nombre no debe ser mayor a :max caracteres.',
            'name.unique' =>' El campo nombre ya ha sido registrado',
            'description.required' =>'El campo descipción es obligatorio',
            'description.string' =>'El campo descripción debe de ser una cadena de texto.',
            'description.max' => 'El campo descripción no debe ser mayor a :max caracteres.',
            'completed.boolean' => 'El campo completado debe de ser un valor booleano'
        ];

    }
}
