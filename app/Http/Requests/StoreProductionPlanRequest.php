<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductionPlanRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'planned_production' => 'array',
            'planned_production.*' => 'required|numeric|min:0',
            'adjusted_production' => 'array',
            'adjusted_production.*' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'planned_production.*.required' => 'The planned production for :attribute is required.',
            'planned_production.*.numeric' => 'The planned production for :attribute must be a number.',
            'planned_production.*.min' => 'The planned production for :attribute must be at least 0.',
        ];
    }

    public function attributes()
    {
        return [
            'planned_production.monday' => 'planned production Monday',
            'planned_production.tuesday' => 'planned production Tuesday',
            'planned_production.wednesday' => 'planned production Wednesday',
            'planned_production.thursday' => 'planned production Thursday',
            'planned_production.friday' => 'planned production Friday',
            'planned_production.saturday' => 'planned production Saturday',
            'planned_production.sunday' => 'planned production Sunday',
        ];
    }
}
