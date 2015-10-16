@extends ('layout')

@section ('title') Comercial @stop


@section ('menu')
    @include ('menu')
@stop

@section ('content')

    <div class="row">
        
        <h3>Performance Comercial</h3>

        <blockquote>
        	This is an example quotation that uses the blockquote tag.
        </blockquote>
    </div>

    <div class="row">

        <div class="input-field col s12">
            <select >
                <option value="1" selected>Por consultor</option>
                <option value="2">Por cliente</option>
            </select>
        </div>
    </div>

    <div class="row">

        <div class="input-field col s2" >
            <select id='mes_uno'>
                <option value="0" selected>Mes</option>
                <option value="1">Ene</option>
                <option value="2">Feb</option>
                <option value="3">Mar</option>
                <option value="4">Abr</option>
                <option value="5">May</option>
                <option value="6">Jun</option>
                <option value="7">Jul</option>
                <option value="8">Ago</option>
                <option value="9">Sep</option>
                <option value="10">Oct</option>
                <option value="11">Nov</option>
                <option value="12">Dic</option>
            </select>
        </div>

        <div class="input-field col s3" >
            <select id='anio_uno'>
                <option value="0" selected>Año</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
            </select>
        </div>

        <div class="input-field col s2 center">
            <p>A</p>
        </div>
        <div class="input-field col s2">
            <select id='mes_dos'>
                <option value="0" selected>Mes</option>
                <option value="1">Ene</option>
                <option value="2">Feb</option>
                <option value="3">Mar</option>
                <option value="4">Abr</option>
                <option value="5">May</option>
                <option value="6">Jun</option>
                <option value="7">Jul</option>
                <option value="8">Ago</option>
                <option value="9">Sep</option>
                <option value="10">Oct</option>
                <option value="11">Nov</option>
                <option value="12">Dic</option>
            </select>
        </div>

        <div class="input-field col s3">
            <select id='anio_dos'>
                <option value="0" selected>Año</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
            </select>
        </div>
    </div>



    <div class="row">

        <div class="col s12 m5 div_slc_multiple" >
            <select multiple class="browser-default select_multiple" id='slc_consultores'>
                @foreach ($consultores as $consultor)
                    <option value='{{ $consultor->co_usuario }}'>{{$consultor->no_usuario}}</option>
                @endforeach
            </select>
        </div>

        <!--<div class="col s12 m5 div_slc_multiple" >
            <select multiple class="browser-default select_multiple" id='slc_consultores'>
                @foreach ($clientes as $cliente)
                    <option value='{{ $cliente->co_cliente }}'>{{$cliente->no_fantasia}}</option>
                @endforeach
            </select>
        </div>-->
    
        <div class="col s12 m2 center">
    
            <div class="col s6 m12">
                <button class="btn waves-effect waves-light center" name="action" id='btn_agregar_slc'>
                    <i class="material-icons center">fast_forward</i>
                </button>
            </div>

            <div class="col s6 m12">
                <button class="btn waves-effect waves-light center" name="action" id='btn_quitar_slc'>
                    <i class="material-icons center">fast_rewind</i>
                </button>
            </div>            

        </div>

        <div class="col s12 m5 div_slc_multiple" >
            <select multiple class="browser-default select_multiple" id='slc_filtro_consultores'>
            </select>
        </div>

    </div>




    <div class="row">

        <div class='col s12 m4'>
            <button class="btn waves-effect waves-light center col s12" name="action" id='op_uno'>
                Relatorio
                    <i class="material-icons right">assignment</i>
            </button>
        </div>
        
        <div class="col s12 m4">
            <button class="btn waves-effect waves-light center col s12" name="action" id='op_dos'>
                Gráfico
                    <i class="material-icons right">equalizer</i>
            </button>
        </div>

        <div class="col s12 m4">
            <button class="btn waves-effect waves-light center col s12" name="action" id='op_tres'>
                Pizza
                <i class="material-icons right">timelapse</i>
            </button>
        </div>

        
    </div>

    <div class="row" id='mostrar_informacion'>


    </div>

    <div id="chartContainer" style="height: 300px; width: 100%;"></div>

    <script src="{{ asset('canvas/canvasjs.min.js') }}"></script>
    
@stop