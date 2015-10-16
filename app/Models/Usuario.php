<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'cao_usuario';

    public function permisos_sistema()
    {
    	return $this->hasOne('App\Models\Permiso', 'co_usuario');
    }
}
