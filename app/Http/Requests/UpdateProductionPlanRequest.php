<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductionPlanRequest extends FormRequest
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

    public function messages(): array
    {
        return [
            'name.required' => 'The production plan name is required.',
            'name.string' => 'The production plan name must be a valid string.',
            'name.max' => 'The production plan name may not be greater than 255 characters.',
            'planned_production.*.required' => 'The planned production for :attribute is required.',
            'planned_production.*.numeric' => 'The planned production for :attribute must be a number.',
            'planned_production.*.min' => 'The planned production for :attribute must be at least 0.',
            'adjusted_production.*.required' => 'The adjusted production for :attribute is required.',
            'adjusted_production.*.numeric' => 'The adjusted production for :attribute must be a number.',
            'adjusted_production.*.min' => 'The adjusted production for :attribute must be at least 0.',
        ];
    }

    public function attributes(): array
    {
        return [
            'planned_production.monday' => 'planned production Monday',
            'planned_production.tuesday' => 'planned production Tuesday',
            'planned_production.wednesday' => 'planned production Wednesday',
            'planned_production.thursday' => 'planned production Thursday',
            'planned_production.friday' => 'planned production Friday',
            'planned_production.saturday' => 'planned production Saturday',
            'planned_production.sunday' => 'planned production Sunday',
            'adjusted_production.monday' => 'adjusted production Monday',
            'adjusted_production.tuesday' => 'adjusted production Tuesday',
            'adjusted_production.wednesday' => 'adjusted production Wednesday',
            'adjusted_production.thursday' => 'adjusted production Thursday',
            'adjusted_production.friday' => 'adjusted production Friday',
            'adjusted_production.saturday' => 'adjusted production Saturday',
            'adjusted_production.sunday' => 'adjusted production Sunday',
        ];
    }
}
