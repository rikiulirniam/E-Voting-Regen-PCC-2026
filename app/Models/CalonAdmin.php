<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalonAdmin extends Model
{
    protected $guarded = [];

    public function votings()
    {
        return $this->hasMany(Voting::class, 'id_calon_admin');
    }
}
