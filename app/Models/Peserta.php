<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Peserta extends Model
{
    protected $guarded = [];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id_peserta');
    }

    public function voting()
    {
        return $this->hasOne(Voting::class, 'id_peserta');
    }
}
