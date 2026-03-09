<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCalonAdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('camin')->id;

        return [
            'name'     => ['required', 'string', 'max:255'],
            'no_urut'  => ['required', 'integer', 'unique:calon_admins,no_urut,' . $id],
            'visi'     => ['required', 'string'],
            'misi'     => ['required', 'string'],
            'foto'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
