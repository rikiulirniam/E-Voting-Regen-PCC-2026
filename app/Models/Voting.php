<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    protected $guarded = [];

    public function calonAdmin()
    {
        return $this->belongsTo(CalonAdmin::class, 'id_calon_admin');
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class, 'id_peserta');
    }
}
