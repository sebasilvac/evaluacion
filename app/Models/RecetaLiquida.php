<?php

namespace App\Models;

use DB;

class RecetaLiquida
{
	private $consultor;
	private $fecha1;
	private $fecha2;
	private $anio1;
	private $anio2;
	public  $receta_liquida;

	public function setConsultor($consultor)
	{
		$this->consultor = $consultor;
	}

	public function setFecha1($fecha1)
	{
		$this->fecha1 = $fecha1;
	}

	public function setFecha2($fecha2)
	{
		$this->fecha2 = $fecha2;
	}

	public function setAnio1($anio1)
	{
		$this->anio1 = $anio1;
	}

	public function setAnio2($anio2)
	{
		$this->anio2 = $anio2;
	}

    public function getRecetaLiquida()
    {

        unset($receta);


        $fecha1 = $this->anio1."-".$this->fecha1."-01";

        $dia = $this->data_last_month_day($this->fecha2, $this->anio2);

        $fecha2 = $dia;

        $datos = DB::table('cao_fatura')

            ->select(  'cao_fatura.valor',
                        'cao_fatura.total_imp_inc', 
                        'cao_fatura.data_emissao',
                        'cao_fatura.comissao_cn',
                        'cao_cliente.co_cliente',
                        'cao_cliente.no_razao',
                        'cao_os.co_usuario',
                        'cao_usuario.no_usuario')

            ->join('cao_cliente', 'cao_cliente.co_cliente', '=', 'cao_fatura.co_cliente')
            ->join('cao_sistema', 'cao_sistema.co_sistema', '=', 'cao_fatura.co_sistema')
            ->join('cao_os'     , 'cao_os.co_os'          , '=', 'cao_fatura.co_os')
            ->join('cao_usuario', 'cao_usuario.co_usuario', '=', 'cao_os.co_usuario')

            ->where('cao_os.co_usuario', $this->consultor)
            ->whereBetween('cao_fatura.data_emissao', array($fecha1, $fecha2))
            ->get();


        $receta = array();


        $receta['mes'][1]['total'] = 0;
        $receta['mes'][2]['total'] = 0;
        $receta['mes'][3]['total'] = 0;
        $receta['mes'][4]['total'] = 0;
        $receta['mes'][5]['total'] = 0;
        $receta['mes'][6]['total'] = 0;
        $receta['mes'][7]['total'] = 0;
        $receta['mes'][8]['total'] = 0;
        $receta['mes'][9]['total'] = 0;
        $receta['mes'][10]['total'] = 0;
        $receta['mes'][11]['total'] = 0;
        $receta['mes'][12]['total'] = 0;

        $estado = false;

        if($datos){

            foreach ($datos as $valor) {

                $impinc         = $valor->total_imp_inc;
                $mes            = intval(date('m', strtotime($valor->data_emissao)));
                $fecha          = $valor->data_emissao;
                $valor_factura  = $valor->valor;
                $anio           = intval(date('Y', strtotime($fecha)));

                if ($impinc == 0) {
                    $valor_receta   = 0;
                    $valor_comision = 0;
                }else{
                    $valor_receta   = round( $valor_factura * $impinc  / 100);
                    $valor_comision = round( $valor_receta * $valor->comissao_cn    / 100);
                }


                $receta[0]['nombre_cliente']    = $valor->no_usuario;
                $receta[0]['co_usuario']        = $valor->co_usuario;

                $receta['mes'][$mes]['mes']         =   $mes;
                $receta['mes'][$mes]['total']       +=  $valor_receta;
                $receta['mes'][$mes]['comision']    =   $valor_comision;
                $receta['mes'][$mes]['anio']        =   $anio;

                $estado = true;
            }

        }

        if($estado){
            $this->receta_liquida = $receta;
        }
        
        
        return $estado;
    }


    public function getResumenRecetaLiquida()
    {

        unset($receta);


        $fecha1 = $this->anio1."-".$this->fecha1."-01";

        $dia = $this->data_last_month_day($this->fecha2, $this->anio2);

        $fecha2 = $dia;

        $datos = DB::table('cao_fatura')

            ->select(  'cao_fatura.valor',
                        'cao_fatura.total_imp_inc',
                        'cao_os.co_usuario',
                        'cao_usuario.no_usuario')

            ->join('cao_cliente', 'cao_cliente.co_cliente', '=', 'cao_fatura.co_cliente')
            ->join('cao_sistema', 'cao_sistema.co_sistema', '=', 'cao_fatura.co_sistema')
            ->join('cao_os'     , 'cao_os.co_os'          , '=', 'cao_fatura.co_os')
            ->join('cao_usuario', 'cao_usuario.co_usuario', '=', 'cao_os.co_usuario')

            ->where('cao_os.co_usuario', $this->consultor)
            ->get();


        $receta = array();

        $estado = false;

        if($datos){

            foreach ($datos as $valor) {

                $impinc         = $valor->total_imp_inc;
                $valor_factura  = $valor->valor;

                if ($impinc == 0) {
                    $valor_receta   = 0;
                }else{
                    $valor_receta   = round( $valor_factura * $impinc  / 100 , 2);
                }

                @$receta['total'] += $valor_receta;
                @$receta['nombre_cliente']    = $valor->no_usuario;
                @$receta['co_usuario']        = $valor->co_usuario;

                $estado = true;
            }

        }

        if($estado){
            $this->receta_liquida = $receta;
        }
        
        
        return $estado;
    }


    public function data_last_month_day($month, $year) { 
        $day = date("d", mktime(0,0,0, $month+1, 0, $year));
        return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
    }
 
    /** Actual month first day **/
    public function data_first_month_day($month, $year) {
        return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
    }

}
