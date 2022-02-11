<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Formulario de Inscripción</title>

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

        td{
            border-top: 1px solid #ccc;
            padding: 4px;
        }

        .trTitulo{
            font-weight: bold;
            margin-top: 1px;
        }

        .trSubTitulo {
            background: #EfEfEf;
            height: 25px;
        }

        table{
            border:0px;
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

    <table style="width: 100%" border="0">
    <tr class="trTitulo">
        <td colspan="4">TAREAS IMPOSITIVAS</td>
    </tr>
    <tr class="trTitulo">
        <td colspan="2" class="trSubTitulo">Descripción</td>
        <td colspan="2" class="trSubTitulo">Precio unitario</td>
    </tr>
    @forelse($tareas_impositivas as $impositiva)
    <tr>
        <td colspan="2">{{$impositiva['descripcion']}}</td>
        <td colspan="2" nowrap>${{number_format($impositiva['precio'], 2)}}</td>
    </tr>
    @empty
    <tr>
        <td colspan="4">Sin tareas agregadas...</td>
    </tr>
    @endforelse
    </table>

    <table style="width: 100%;margin-top:15px;" border="0">
    <tr class="trTitulo">
        <td colspan="4">TAREAS LABORALES</td>
    </tr>
    <tr class="trTitulo">
        <td colspan="2" class="trSubTitulo">Descripción</td>
        <td colspan="2" class="trSubTitulo">Precio unitario</td>
    </tr>
    @forelse($tareas_laborales as $laboral)
    <tr>
        <td colspan="2">{{$laboral['descripcion']}}</td>
        <td colspan="2" nowrap>${{number_format($laboral['precio'], 2)}}</td>
    </tr>
    @empty
    <tr>
        <td colspan="4">Sin tareas agregadas...</td>
    </tr>
    @endforelse
    </table>

    <table style="width: 100%;margin-top:15px;" border="0">
    <tr class="trTitulo">
        <td colspan="4">OTRAS TAREAS</td>
    </tr>
    <tr class="trTitulo">
        <td colspan="2" class="trSubTitulo">Descripción</td>
        <td colspan="2" class="trSubTitulo">Precio unitario</td>
    </tr>
    @forelse($tareas_otros as $otro)
    <tr>
        <td colspan="2">{{$otro['descripcion']}}</td>
        <td colspan="2" nowrap>${{number_format($otro['precio'], 2)}}</td>
    </tr>
    @empty
    <tr>
        <td colspan="4">Sin tareas agregadas...</td>
    </tr>
    @endforelse
    </table>
    
    <table style="width: 100%;margin-top:20px;" border="0">
        <tr>
            <td colspan="5">Total: <b>${{number_format($total, 2)}}</b></td>
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