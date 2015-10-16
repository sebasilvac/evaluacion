<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Input;
use Response;

use App\Models\Salario;
use App\Models\Cliente;
use App\Models\Consultor;
use App\Models\RecetaLiquida;

class ComercialPerformanceController extends Controller
{

	public function index()
	{
		// Obtenemos los consultores
		$consultor =	new Consultor();
		$consultores = $consultor->getAllConsultores();

		$cliente = new Cliente();
		$clientes = $cliente->getAllClientes();

		return view('comercial.performance')
				->with('clientes', $clientes)
				->with('consultores', $consultores);
	}

	public function getOp1()
	{	

		$mes1 = Input::get('mes_uno');
		$mes2 = Input::get('mes_dos');

		$anio1 = Input::get('anio_uno');
		$anio2 = Input::get('anio_dos');

		$consultores = Input::get('slc');


		$receta = new RecetaLiquida();
		$receta->setFecha1($mes1);
		$receta->setFecha2($mes2);
		$receta->setAnio1($anio1);
		$receta->setAnio2($anio2);

		$num = false;// verificamos si por lo menos existe un registro para mostrar
		$tabla = "<table class='responsive-table highlight bordered'>";

		foreach ($consultores as $consultor) {

			$receta->setConsultor($consultor);

			if($receta->getRecetaLiquida()){

				$datos = $receta->receta_liquida;

				$tabla .= "	<tr><th colspan='5'>".$datos[0]['nombre_cliente']."</th></tr>";

				$tabla .= "<tr><th>Periodo</th>";
				$tabla .= "<th>Receta liquida</th>";
				$tabla .= "<th>Costo fijo</th>";
				$tabla .= "<th>Comisión</th>";
				$tabla .= "<th>Lucro</th></tr>";


				foreach ($datos['mes'] as $key => $mes) {
						
					if($mes['total'] != 0){

						$costo_fijo	= Salario::where('co_usuario', '=', $datos[0]['co_usuario'] )->first();
						$costo_fijo = $costo_fijo['brut_salario'];

						if(empty($costo_fijo)){
							$costo_fijo = 0;
						}

						$tabla .= "<td>".$mes['mes']."/".$mes['anio']."</td>";
						$tabla .= "<td>".$mes['total']."</td>";
						$tabla .= "<td>".$costo_fijo."</td>";
						$tabla .= "<td> - ".$mes['comision']."</td>";
						$tabla .= "<td>".($mes['total'] - ($costo_fijo + $mes['comision']))."</td>";
						$tabla .= "</tr>";

					}
				}

				$num = true;
			}
		}

		$data = array();
		
		if(!$num){
			$data['error'] = "No se encontraron datos.";
			$data['estado'] = false;
		}else{
			
			$data['tabla'] = $tabla;
			$data['estado'] = true;
		}
			
		return Response::json($data);
	}

	public function getOp2()
	{	
		$data = array();


		$mes1 = Input::get('mes_uno');
		$mes2 = Input::get('mes_dos');
		$anio1 = Input::get('anio_uno');
		$anio2 = Input::get('anio_dos');
		$consultores = Input::get('slc');

		$receta = new RecetaLiquida();
		$receta->setFecha1($mes1);
		$receta->setFecha2($mes2);
		$receta->setAnio1($anio1);
		$receta->setAnio2($anio2);

		$i = 0;

		$json = '';

		foreach ($consultores as $consultor) {
			
			$receta->setConsultor($consultor);

			if($receta->getRecetaLiquida()){


				$datos = $receta->receta_liquida;

				$nombre_cliente = $datos[0]['nombre_cliente'];

				$json[$i]['type'] 				= 'column';
				$json[$i]['name'] 				= $nombre_cliente;
				$json[$i]['legendText']			= $nombre_cliente;
				$json[$i]['showInLegend']		= true;

				$imes = 0;
				
				foreach ($datos['mes'] as $key => $mes) {
						
					if($mes['total'] != 0){

						$json[$i]['dataPoints'][$imes]['label'] = $mes['mes']."/".$mes['anio'];
						$json[$i]['dataPoints'][$imes]['y'] 	= $mes['total'];

						$imes++;

					}
				}

				$i++;
			}

		}

		//dd($json);

		if($i==0){
			$data['error'] = "No se encontraron datos.";
			$data['estado'] = false;
		}else{
			
			$data['data'] = $json;
			$data['estado'] = true;
		}



		return Response::json($data);
	}

	public function getOp3()
	{	

		$data = array();


		$mes1 = Input::get('mes_uno');
		$mes2 = Input::get('mes_dos');
		$anio1 = Input::get('anio_uno');
		$anio2 = Input::get('anio_dos');
		$consultores = Input::get('slc');

		$receta = new RecetaLiquida();
		$receta->setFecha1($mes1);
		$receta->setFecha2($mes2);
		$receta->setAnio1($anio1);
		$receta->setAnio2($anio2);

		$i = 0;

		$json = '';

		$total_receta = 0;

		foreach ($consultores as $consultor) {
			
			$receta->setConsultor($consultor);

			if($receta->getResumenRecetaLiquida()){


				$datos = $receta->receta_liquida;

				$total_con[$datos['co_usuario']]['total'] 	= $datos['total'];
				$total_con[$datos['co_usuario']]['nombre'] 	= $datos['nombre_cliente'];

				$total_receta += $datos['total'];
					
			}

		}


		foreach ($total_con as $key => $value) {


			$total = round( $value['total'] * 100 / $total_receta , 2); 

			//dd($total);

			
			$json[$i]['y'] 				= $total;
			$json[$i]['legendText']		= $value['nombre']." ".$total."%";
			$json[$i]['indexLabel']		= $value['nombre']." ".$total."%";

			$i++;

		}

		if($i==0){
			$data['error'] = "No se encontraron datos.";
			$data['estado'] = false;
		}else{
			
			$data['data'] = $json;
			$data['estado'] = true;
		}



		return Response::json($data);

	}
}