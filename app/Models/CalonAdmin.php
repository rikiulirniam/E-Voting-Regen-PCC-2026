<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CalonAdmin extends Model
{
    protected $guarded = [];

    protected $appends = ['foto_url'];

    public function votings()
    {
        return $this->hasMany(Voting::class, 'id_calon_admin');
    }

    public function getFotoUrlAttribute(): ?string
    {
        $foto = $this->attributes['foto'] ?? null;

        if (!$foto) {
            return null;
        }

        if (Str::startsWith($foto, ['http://', 'https://'])) {
            return $foto;
        }

        $normalized = ltrim((string) preg_replace('#^/?storage/#', '', $foto), '/');

        return route('media.show', ['path' => $normalized]);
    }
}
