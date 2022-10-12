<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AbstractRequest
 * @package App\Http\Requests
 */
abstract class AbstractRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * @param $prefix
     * @return array
     */
    public function prefixedRules($prefix): array
    {
        $rules = $this->rules();

        return array_combine(
            array_map(fn($keys) => $prefix . $keys, array_keys($rules)),
            $rules
        );
    }

    protected function failedValidation(Validator $validator)
    {
        parent::failedValidation($validator);
    }
}
