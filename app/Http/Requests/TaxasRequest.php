<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaxasRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', Rule::unique('taxes', 'name')->ignore($this->tax)],
            'price' => ['required', 'integer', 'min:0'],
            'status' => ['required', 'boolean'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Pajak Harus Diisi',
            'name.unique' => 'Nama Pajak Sudah Ada',
            'price.required' => 'Nominal Pajak Harus Diisi',
            'price.integer' => 'Nominal Pajak Harus Berupa Angka',
            'price.min' => 'Minimal Nominal Pajak 0',
            'status.required' => 'Status Harus Diisi',
        ];
    }
}
