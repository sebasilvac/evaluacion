$(document).ready(function(){

	// Variables Globales
	var filtros;

	$('.button-collapse').sideNav({
		menuWidth: 300, // Default is 240
		edge: 'left', // Choose the horizontal origin
		closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
		}
	);

	$(".dropdown-button").dropdown();

    $('select').material_select();



    $(document).on('click', '#btn_agregar_slc', function(){
    	 agregar_slc();
    });

    $(document).on('click', '#btn_quitar_slc', function(){
    	quitar_slc();
    });

    $(document).on('click', '#op_uno', function(){
    	genera_info_op1();
    });

    $(document).on('click', '#op_dos', function(){
    	genera_info_op2();
    });

    $(document).on('click', '#op_tres', function(){
    	genera_info_op3();
    });


    function agregar_slc()
    {
    	$('#slc_consultores option:selected').each(function(){

    		$("#slc_filtro_consultores").append($(this));

    	});
    }

    function quitar_slc()
    {
    	$('#slc_filtro_consultores option:selected').each(function(){

    		$("#slc_consultores").append($(this));

    	});
    }

    function obtener_filtros()
    {
    	filtro_mes_uno	=	$('#mes_uno').val();
		filtro_anio_uno	=	$('#anio_uno').val();
		filtro_mes_dos	=	$('#mes_dos').val();
		filtro_anio_dos	=	$('#anio_dos').val();

        // Validación de datos
        
        if (filtro_mes_uno  == 0){ alert('Favor seleccione los filtros correspondientes.'); return false; }
        if (filtro_anio_uno == 0){ alert('Favor seleccione los filtros correspondientes.'); return false; }
        if (filtro_mes_dos  == 0){ alert('Favor seleccione los filtros correspondientes.'); return false; }
        if (filtro_anio_dos == 0){ alert('Favor seleccione los filtros correspondientes.'); return false; }


        // Segundo año no puede ser menor al primero
        // si años son iguales comparar mes, el segundo no puede ser menor al primero
        
        if(filtro_anio_dos < filtro_anio_uno){
            alert("Fecha incorrecta, favor verificar el año seleccionado.");
            return false;
        }

        if(filtro_anio_uno == filtro_anio_dos){

            if(filtro_mes_uno > filtro_mes_dos){
                alert("Fecha incorrecta, favor verificar el mes seleccionado.");
                return false;
            }
        }

		var slc = [] ;

		$('#slc_filtro_consultores option').each(function(){
    		slc.push($(this).val());
    	});

        if(slc.length == 0){
            alert("Favor seleccione consultores.");
            return false;
        }

    	filtros = {
    		'mes_uno': filtro_mes_uno,
    		'anio_uno': filtro_anio_uno,
    		'mes_dos': filtro_mes_dos,
    		'anio_dos': filtro_anio_dos,
    		'slc': slc
    	}

        return true;

    }

    function genera_info_op1()
    {
    	if(!obtener_filtros()){
            return false;
        }

    	$.ajax({
    		async: true,
    		type:  'post',
            data:  filtros,
            url:   '/opcion_uno',
            dataType:'json',
            success:  function (data){
            	if(data.estado){

            		$("#mostrar_informacion").html(data.tabla);

                    $("#chartContainer").html('');
                    $("#mostrar_informacion").show();

            	}else{
                    $("#chartContainer").html('');
                    $("#mostrar_informacion").html('');
            		alert(data.error);
            	}
            }
        });
    }

    function genera_info_op2()
    {
    	if(!obtener_filtros()){
            return false;
        }

    	$.ajax({
    		async: true,
    		type:  'post',
            data:  filtros,
            url:   '/opcion_dos',
            dataType:'json',
            success:  function (data){

            	if(data.estado){

                    console.log(data.data);
                    carga_chart1(data.data);

                    $("#mostrar_informacion").html('');
                    $("#chartContainer").show();


            	}else{
                    $("#chartContainer").html('');
                    $("#mostrar_informacion").html('');
            		alert(data.error);
            	}
            }
        });
    }

    function genera_info_op3()
    {
    	if(!obtener_filtros()){
            return false;
        }

    	$.ajax({
    		async: true,
    		type:  'post',
            data:  filtros,
            url:   '/opcion_tres',
            dataType:'json',
            success:  function (data){
            	if(data.estado){

                    carga_chart(data.data);

                    $("#mostrar_informacion").html('');
                    $("#chartContainer").show();

            	}else{
                    $("#chartContainer").html('');
                    $("#mostrar_informacion").html('');
            		alert(data.error);
            	}
            }
        });
    }




function carga_chart(json) {

    var chart = new CanvasJS.Chart("chartContainer",
    {
        title:{
            text: "Performance Comercial",
            fontFamily: "Impact",
            fontWeight: "normal"
        },

        legend:{
            verticalAlign: "bottom",
            horizontalAlign: "center"
        },
        data: [
        {
            //startAngle: 45,
            indexLabelFontSize: 20,
            indexLabelFontFamily: "Garamond",
            indexLabelFontColor: "darkgrey",
            indexLabelLineColor: "darkgrey",
            indexLabelPlacement: "outside",
            type: "doughnut",
            showInLegend: true,
            dataPoints: json
        }
        ]
    });

    chart.render();
}


function carga_chart1(json) {

        var chart = new CanvasJS.Chart("chartContainer",
        {
            theme: "theme3",
                        animationEnabled: true,
            title:{
                text: "Performance Comercial",
                fontSize: 30
            },
            toolTip: {
                shared: true
            },          
            axisY: {
                title: "R$"
            },
            axisY2: {
                title: "R$"
            },          
            data: json,
          legend:{
            cursor:"pointer",
            itemclick: function(e){
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
              }
              else {
                e.dataSeries.visible = true;
              }
                chart.render();
            }
          },
        });

chart.render();
}

});