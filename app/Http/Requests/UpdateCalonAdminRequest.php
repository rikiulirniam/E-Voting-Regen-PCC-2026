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

    protected function prepareForValidation(): void
    {
        $this->merge([
            'visi' => $this->normalizeMultiline($this->input('visi')),
            'misi' => $this->normalizeMultiline($this->input('misi')),
        ]);
    }

    private function normalizeMultiline(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = preg_replace("/\r\n?|\r/", "\n", $value);
        $lines = explode("\n", (string) $normalized);
        $trimmedLines = array_map(static fn (string $line): string => trim($line), $lines);

        while (!empty($trimmedLines) && $trimmedLines[0] === '') {
            array_shift($trimmedLines);
        }

        while (!empty($trimmedLines) && end($trimmedLines) === '') {
            array_pop($trimmedLines);
        }

        return implode("\n", $trimmedLines);
    }
}
