<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseFilterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'term' => ['nullable', 'in:前期,後期'],
            'day' => ['nullable', 'in:月,火,水,木,金'],
            'period' => ['nullable', 'in:1,2'],
            'search' => ['nullable', 'string', 'max:50'],
        ];
    }
}