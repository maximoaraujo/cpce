<?php

namespace App\Http\Controllers;
use PDF;
use DB;

use Illuminate\Http\Request;
use App\Models\Operadores_monitor;
use App\Models\Valores;
use App\Models\Valores_adicionals;
use App\Models\Valores_empleado;
use App\Models\Presupuesto;
use App\Models\Honorarios_presupuesto;

class HonorariosController extends Controller
{
    public function calcular_honorario()
    {
        if (session('userid') != null) {
            $name = Operadores_monitor::where('OperadorMonitorId', session('userid'))->pluck('NombreApellido');
            foreach ($name as $n) {
                $username = $n;
            }

            return view('honorarios.calcular-honorarios', compact('username'));
        } else {
            return view('auth.login');
        }
    }

    public function imprimir_presupusto($presupuesto)
    {
        if (session('userid') != null) {
            $descarga = 0;

            $tareas_impositivas = [];
            $total_impositivas = 0;
            $tareas_impositivas = Honorarios_presupuesto::where('presupuesto_id', $presupuesto)->where('tipo', 'impositivo')->get();
            $total_impositivas = Honorarios_presupuesto::where('presupuesto_id', $presupuesto)->where('tipo', 'impositivo')->sum('total');

            $tareas_laborales = [];
            $total_laborales = 0;
            $tareas_laborales = Honorarios_presupuesto::where('presupuesto_id', $presupuesto)->where('tipo', 'laboral')->get();
            $total_laborales = Honorarios_presupuesto::where('presupuesto_id', $presupuesto)->where('tipo', 'laboral')->sum('total');
            
            $tareas_otros = [];
            $total_otros = 0;
            $tareas_otros = Honorarios_presupuesto::where('presupuesto_id', $presupuesto)->where('tipo', 'otros')->get();
            $total_otros = Honorarios_presupuesto::where('presupuesto_id', $presupuesto)->where('tipo', 'otros')->sum('total');
        
            $total = number_format($total_impositivas + $total_laborales + $total_otros, 2);

            $presupuesto_id = Presupuesto::where('presupuesto_id', $presupuesto)->pluck('id')->first();
            $presupuesto = Presupuesto::find($presupuesto_id);

            $pdf =  PDF::loadView('honorarios/pdf/presupuesto', compact('presupuesto', 'tareas_impositivas', 'tareas_laborales', 'tareas_otros', 'total_impositivas', 'total_laborales', 'total_otros', 'total'))->setPaper(array(0,0,595.4,841.4),'portrait');
            if ($descarga) {
                return $pdf->download('Presupuesto-'.$presupuesto.'.pdf');
            } else {
                return $pdf->stream();
            }
        } else {
            return view('auth.login');
        }
    }

    public function presupuestos()
    {
        if (session('userid') != null) {
            $name = Operadores_monitor::where('OperadorMonitorId', session('userid'))->pluck('NombreApellido');
            foreach ($name as $n) {
                $username = $n;
            }

            return view('honorarios.presupuestos', compact('username'));
        } else {
            return view('auth.login');
        }
    }

    public function tablas_calculos($tabla)
    {
        $name = Operadores_monitor::where('OperadorMonitorId', session('userid'))->pluck('NombreApellido');
        foreach ($name as $n) {
            $username = $n;
        }

        return view('honorarios.tabla-calculos', compact('username', 'tabla'));
    }
}
