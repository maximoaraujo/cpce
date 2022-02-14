<?php

namespace App\Http\Controllers;
use PDF;

use Illuminate\Http\Request;
use App\Models\Operadores_monitor;
use App\Models\Valores;
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

            $impositivas = Honorarios_presupuesto::where('presupuesto_id', $presupuesto)->pluck('impositivos')->first();
            $laborales = Honorarios_presupuesto::where('presupuesto_id', $presupuesto)->pluck('laborales')->first();
            $otros = Honorarios_presupuesto::where('presupuesto_id', $presupuesto)->pluck('otros')->first();

            $tareas_impositivas = [];
            $total_impositivas = 0;
            if($impositivas != '[""]'){
                foreach(json_decode($impositivas) as $id){               
                    array_push($tareas_impositivas, Valores::select('descripcion','precio')->where('id', $id)->first());
                    $total_impositivas = Valores::where('id', $id)->sum('precio') + $total_impositivas;
                }
            }

            $tareas_laborales = [];
            $total_laborales = 0;
            if($laborales != '[""]'){
                foreach(json_decode($laborales) as $id){               
                    array_push($tareas_laborales, Valores::select('descripcion','precio')->where('id', $id)->first());
                    $total_laborales = Valores::where('id', $id)->sum('precio') + $total_laborales;
                }
            }

            $tareas_otros = [];
            $total_otros = 0;
            if($otros != '[""]'){
                foreach(json_decode($otros) as $id){               
                    array_push($tareas_otros, Valores::select('descripcion','precio')->where('id', $id)->first());
                    $total_otros = Valores::where('id', $id)->sum('precio') + $total_otros;
                }
            }

            $total = floatval($total_impositivas) + floatval($total_laborales) + floatval($total_otros);

            $pdf =  PDF::loadView('honorarios/pdf/presupuesto', compact('tareas_impositivas', 'tareas_laborales', 'tareas_otros', 'total'))->setPaper(array(0,0,595.4,841.4),'portrait');
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
}
