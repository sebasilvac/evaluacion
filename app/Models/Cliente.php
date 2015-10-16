<?php

namespace App\Models;

use DB;

class Cliente
{


    public function getAllClientes()
    {
    	$clientes = DB::table('cao_cliente')
            ->select('co_cliente', 'no_razao', 'no_fantasia')
            ->get();

        return $clientes;
    }


}
