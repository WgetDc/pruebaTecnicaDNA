<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public function perfil(){
        return $this->hasOne(Perfil::class);
    }
}
