<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePesertaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:csv,txt', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'File CSV wajib diunggah.',
            'file.mimes'    => 'File harus berformat CSV.',
            'file.max'      => 'Ukuran file maksimal 5MB.',
        ];
    }
}
