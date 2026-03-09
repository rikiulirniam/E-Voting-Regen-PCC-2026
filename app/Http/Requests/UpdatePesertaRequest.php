<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePesertaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $peserta = $this->route('peserta');
        $pesertaId = $peserta->id;
        $userId    = $peserta->user?->id;

        return [
            'name'           => ['required', 'string', 'max:255'],
            'nim'            => ['required', 'string', 'max:50', 'unique:pesertas,nim,' . $pesertaId],
            'email'          => ['required', 'email', 'max:255', 'unique:pesertas,email,' . $pesertaId],
            'username'       => ['required', 'string', 'max:50', 'unique:users,username,' . $userId],
            'status_jabatan' => ['required', 'in:anggota aktif,STO'],
            'status_vote'    => ['required', 'in:belum,sudah'],
        ];
    }
}
