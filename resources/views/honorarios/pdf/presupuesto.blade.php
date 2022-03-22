<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Presupuesto</title>

        <style>
        body{
            margin-left: 0.6cm;
            margin-right: 0.6cm;
            font-family: 'sans-serif';
            font-size:14px;
        }

        .titulo{
            font-weight: bold;
            text-align: center;
            font-size:28px;
        }

        .subTitulo{
            font-weight: bold;
            text-align: center;
            font-size:20px;
        }

        .texto{
            text-align: justify;
            font-size:16px;
        }
        .textoMayus {
            text-transform: uppercase;
        }

        .textoTitulo {
            font-weight: bold;
            font-size:18px;
        }

        .subrrayado {
            text-decoration: underline;
            font-size:17px;
        }

        .subrrayadoSolo {
            text-decoration: underline;
        }

        .page-break {
            page-break-after: always;
        }

        .header{
            font-size: 16px;
            text-align: center;
        }

        .logoImg{
            margin-bottom: 10px;
        }

        .tituloHeader{
            font-weight: bold;
            font-size: 25px;
            text-decoration: underline;
        }

        .subTituloHeader{
            font-weight: bold;
            font-size: 21px;
            text-decoration: underline;
        }

        .formHeader{
            font-weight: bold;
            margin: 10px 0px 13px 0px;
        }

        .subHeader{
            font-size: 16px;
        }

        .SHnumero{

        }

        .SHlugar{
            text-align: right;
        }

        .SHreferencia{
            margin: 20px 0px 10px 0px;

        }
        .SHfechaInstConstTexto {
            text-transform: capitalize;
        }

        hr {
            border:0.1px solid #888;
        }

        table, th, td {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .col1{
            width: 40%;
        }

        .col2{
            width: 10%;
        }

        .center{
            text-align: center;
        }

        .textoChico{
            font-size: 9px
        }
        </style>
    </head>
    <body>


    <div class="header">
        <div class="logoImg">
        <img src="{{public_path() .'/images/logo_blanco.jpg'}}" width="100px">
        </div>
        <div class="tituloHeader">CONSEJO PROFESIONAL DE CIENCIAS ECONÓMICAS <br>
        </div>
        <div class="subTituloHeader">
        
        </div>
        <div class="formHeader">
            PRESUPUESTO
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style = "width:500%;">Descripción</th>
                <th>Cant.</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tareas_impositivas as $impositiva)
                <tr>
                    @if($impositiva->valores->valor_minimo > 0)
                    <td style = "width:500%;padding:10px;">{{$impositiva->valores->descripcion}}, <span style ="text-decoration:underline;">con un valor mínimo de {{number_format($impositiva->valores->valor_minimo, 2)}}</span></td>
                    @else
                    <td style = "width:500%;padding:10px;">{{$impositiva->valores->descripcion}}</td>
                    @endif
                    <td style = "text-align:center;">{{$impositiva->cantidad}}</td>
                    <td style = "text-align:center;">${{number_format($impositiva->precio, 2)}}</td>
                    <td style = "text-align:center;">${{number_format(($impositiva->precio * $impositiva->cantidad), 2)}}</td>
                </tr>
            @empty
            <tr>
                <td colspan = "4" style = "padding:10px;">Sin tareas agregadas...</td>
            </tr>
            @endforelse
            <tr>
                <td colspan="4">TOTAL TAREAS IMPOSITIVAS: ${{number_format($total_impositivas, 2)}}</td>
            </tr>
        </tbody>
    </table>

    <table style = "margin-top:20px;">
        <thead>
            <tr>
                <th style = "width:500%;">Descripción</th>
                <th>Cant.</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tareas_laborales as $laborales)
                <tr>
                    @if($laborales->valores->valor_minimo > 0)
                    <td style = "width:500%;padding:10px;">{{$laborales->valores->descripcion}} @if($laborales->empleados > 0) por un total de {{$laborales->empleados}} empleados @endif, <span style ="text-decoration:underline;">con un valor mínimo de {{number_format($laborales->valores->valor_minimo, 2)}}</span></td>
                    @else
                    <td style = "width:500%;padding:10px;">{{$laborales->valores->descripcion}} @if($laborales->empleados > 0) por un total de {{$laborales->empleados}} empleados @endif</td>
                    @endif
                    <td style = "text-align:center;">{{$laborales->cantidad}}</td>
                    <td style = "text-align:center;">${{number_format($laborales->precio, 2)}}</td>
                    <td style = "text-align:center;">${{number_format(($laborales->precio * $laborales->cantidad), 2)}}</td>
                </tr>
            @empty
            <tr>
                <td colspan = "4" style = "padding:10px;">Sin tareas agregadas...</td>
            </tr>
            @endforelse
            <tr>
                <td colspan="4">TOTAL TAREAS LABORALES: ${{number_format($total_laborales, 2)}}</td>
            </tr>
        </tbody>
    </table>

    <table style = "margin-top:20px;">
        <thead>
            <tr>
                <th style = "width:500%;">Descripción</th>
                <th>Cant.</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tareas_otros as $otros)
                <tr>
                    @if($otros->valores->valor_minimo > 0)
                    <td style = "width:500%;padding:10px;">{{$otros->valores->descripcion}}, <span style ="text-decoration:underline;">con un valor mínimo de {{number_format($otros->valores->valor_minimo, 2)}}</span></td>
                    @else
                    <td style = "width:500%;padding:10px;">{{$otros->valores->descripcion}}</td>
                    @endif
                    <td style = "text-align:center;">{{$otros->cantidad}}</td>
                    <td style = "text-align:center;">${{number_format($otros->precio, 2)}}</td>
                    <td style = "text-align:center;">${{number_format(($otros->precio * $otros->cantidad), 2)}}</td>
                </tr>
            @empty
            <tr>
                <td colspan = "4" style = "padding:10px;">Sin tareas agregadas...</td>
            </tr>
            @endforelse
            <tr>
                <td colspan="4">TOTAL OTRAS TAREAS: ${{number_format($total_otros, 2)}}</td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%;margin-top:20px;border-left:none;">
        <tr>
            <td colspan="5" style = "font-size:20px;text-align:right;">Total: <b>${{$total}}</b></td>
        </tr>
    </table>

    <hr style="border-top: dashed 1px;">
        <p style="text-align: center;">
            <b>Direccion: </b>Carlos Pellegrini 1150. W3400 Corrientes.
        <br>
            <b>Tel: </b>0379 442-2884 / <b>Email: </b>informes@cpcecorrientes.org.ar
        <br>
            <b>Facebook: </b>Cpce Corrientes / <b>Webpage: </b>https://cpcecorrientes.org.ar/
        </p>
    </body>
</html>