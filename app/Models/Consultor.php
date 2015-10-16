<?php

namespace App\Models;

use DB;

class Consultor
{


    public function getAllConsultores()
    {
    	$consultores = DB::table('cao_usuario')
            ->join('permissao_sistema', 'cao_usuario.co_usuario', '=', 'permissao_sistema.co_usuario')
            ->select('cao_usuario.co_usuario', 'cao_usuario.no_usuario')
            ->where('permissao_sistema.co_sistema', 1)
            ->where('permissao_sistema.in_ativo', 'S')
            ->whereIn('permissao_sistema.co_tipo_usuario', [0,1,2] )
            ->get();


        return $consultores;
    }


}
