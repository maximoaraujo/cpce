<?php

namespace App\Http\Livewire\Honorarios;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use Livewire\Component;
use App\Models\Valores;
use App\Models\Honorarios_presupuesto;
use App\Models\Valores_adicionals;
use App\Models\Valores_empleado;

class CalcularHonorario extends Component
{
    public $presupuesto, $estado, $buscar;
    public $check_impositivo, $impositivo_id, $laboral_id, $otro_id, $cantidad = 1, $importe, $empleados;
    public $valor, $valor_total, $valor_empleados;
    public $subtipos_impositivo = [];
    public $subtipos_laboral = [];
    public $subtipos_otros = [];
    public $tareas_impositivas = [];
    public $tareas_laborales = [];
    public $tareas_otros = [];

    public function cambio_valores()
    {
        $valores_impositivos = Valores::where('cantidad', 1)->where('calculo', 1)->get();
        foreach ($valores_impositivos as $valor) {
            $valor_a_cambiar = Valores::find($valor->id);
            $valor_a_cambiar->cantidad = 0;

            $valor_a_cambiar->save();
        }

        $valores_laborales = Valores::where('cantidad', 1)->where('empleados', 1)->get();
        foreach ($valores_laborales as $valor) {
            $valor_a_cambiar = Valores::find($valor->id);
            $valor_a_cambiar->cantidad = 0;

            $valor_a_cambiar->save();
        }
    }

    public function generar_sesion()
    {
        if (!Session::has('presupuesto')) {
            $code = Str::random(15);
            session(['presupuesto' => $code]);
        }
    }

    public function mount()
    {
        $this->generar_sesion();
        $this->cargo_impositivos();
        $this->cargo_laborales();
        $this->cargo_otros();
        $this->cambio_valores();
    }

    //Cargamos los valores impositivos
    public function cargo_impositivos()
    {
        //Agrupamos por subtipos
        $subtipos = Valores::select('subtipo')->where('tipo', 'impositivo')->groupBy('subtipo')->get();

        //Recorremos los subtipos y los almacenamos en un array
        foreach ($subtipos as $subtipo) {
            $array_subtipos[] = $subtipo->subtipo;
        }
        //Pasamos el array de subtipos a nuestro elemento
        $this->subtipos_impositivo = $array_subtipos;
    }

    //Cargamos los valores laborales
    public function cargo_laborales()
    {
        //Agrupamos por subtipos
        $subtipos = Valores::select('subtipo')->where('tipo', 'laboral')->groupBy('subtipo')->get();

        //Recorremos los subtipos y los almacenamos en un array
        foreach ($subtipos as $subtipo) {
            $array_subtipos[] = $subtipo->subtipo;
        }
        //Pasamos el array de subtipos a nuestro elemento
        $this->subtipos_laboral = $array_subtipos;
}

    //Cargamos los demas valores
    public function cargo_otros()
    {
        //Agrupamos por subtipos
        $subtipos = Valores::select('subtipo')->where('tipo', 'otros')->groupBy('subtipo')->get();

        //Recorremos los subtipos y los almacenamos en un array
        foreach ($subtipos as $subtipo) {
            $array_subtipos[] = $subtipo->subtipo;
        }
        //Pasamos el array de subtipos a nuestro elemento
        $this->subtipos_otros = $array_subtipos;
    }

    //Click en una descripción de impositivos
    public function impositivoID($impositivo_id)
    {  
        $this->impositivo_id = $impositivo_id;
        $this->dispatchBrowserEvent('check-id', ['id' => $impositivo_id]);
        $this->valor = Valores::find($this->impositivo_id);
        $agregado = Honorarios_presupuesto::where('valor_id', $this->valor->id)->where('presupuesto_id', session('presupuesto'))->count();

        if ($this->valor->cantidad) {
            if ($agregado == 0) {
                $this->dispatchBrowserEvent('tiene-cantidad', []);
            } else {
                $this->quitar_presupuesto();
            }
        } elseif ($this->valor->calculo) {
            if ($agregado == 0) {
                $this->dispatchBrowserEvent('tiene-calculo', []);
            } else {
                $this->quitar_presupuesto();
            }
        } else {
            if ($agregado == 0) {
                $this->guadar_presupuesto();
            } else {
                $this->quitar_presupuesto();
            }
        } 
    }

    //Click en una descripción de laborales
    public function laboralID($laboral_id)
    {  
        $this->laboral_id = $laboral_id;
        $this->dispatchBrowserEvent('check-id', ['id' => $laboral_id]);
        $this->valor = Valores::find($this->laboral_id);
        $agregado = Honorarios_presupuesto::where('valor_id', $this->valor->id)->where('presupuesto_id', session('presupuesto'))->count();

        if ($this->valor->cantidad) {
            if ($agregado == 0) {
                $this->dispatchBrowserEvent('tiene-cantidad', []);
            } else {
                $this->quitar_presupuesto();
            }
        } elseif ($this->valor->empleados) {
            if ($agregado == 0) {
                $this->dispatchBrowserEvent('tiene-empleados', []);
            } else {
                $this->quitar_presupuesto();
            }
        } else {
            if ($agregado == 0) {
                $this->guadar_presupuesto();
            } else {
                $this->quitar_presupuesto();
            }
        }          
    }

    //Click en una descripción de otros
    public function otroID($otro_id)
    {  
        $this->otro_id = $otro_id;
        $this->dispatchBrowserEvent('check-id', ['id' => $otro_id]);
        $this->valor = Valores::find($this->otro_id);
        $agregado = Honorarios_presupuesto::where('valor_id', $this->valor->id)->where('presupuesto_id', session('presupuesto'))->count();

        if ($this->valor->cantidad) {
            if ($agregado == 0) {
                $this->cantidad = 1;
                $this->dispatchBrowserEvent('tiene-cantidad', []);
            } else {
                $this->quitar_presupuesto();
            }
        } else {
            if ($agregado == 0) {
                $this->guadar_presupuesto();
            } else {
                $this->quitar_presupuesto();
            }
        } 
    }

    public function calcular()
    {
        $valores_a_comparar = Valores_adicionals::orderBy('valor')->get();

        if(($this->importe == null)||($this->importe == 0)||($this->importe <= 158600.00)){
            $this->dispatchBrowserEvent('notify', ['msj' => 'Por favor ingrese un importe valido.', 'type' => 'warning']);
        } else {
            foreach ($valores_a_comparar as $valor) {
                if ($this->importe > $valor->valor) {
                    $valor_calculo = $valor->valor;
                    $valor_importe = $valor->importe;
                    $valor_porcentaje = $valor->porcentaje; 
                }
            }
            $valor_resta = $this->importe - $valor_calculo;
            $valor_multi = $valor_resta * $valor_porcentaje / 100;
            $this->valor_total = round($valor_importe + $valor_multi);
            
            if($this->valor_total > 0){
                $this->guadar_presupuesto();
                $this->dispatchBrowserEvent('calculo-ok', []);
            }
        }
    }

    public function calcular_empleados()
    {
        if (($this->empleados == null)||($this->empleados == 0)) {
            $this->dispatchBrowserEvent('notify', ['msj' => 'Por favor ingrese una cantidad valida.', 'type' => 'warning']);
        } else {
            $valor_id = Valores_empleado::where('min', '<=', $this->empleados)->where('max', '>=', $this->empleados)->pluck('id')->first();
            $valor_aplicar = Valores_empleado::find($valor_id);
    
            $this->valor_empleados = ($this->empleados * $valor_aplicar->importe) + $valor_aplicar->total;
            if ($this->valor_empleados > 0) {
                $this->guadar_presupuesto();
                $this->dispatchBrowserEvent('calculo-empleados-ok', []);
            }
        }   
    }

    public function editarCantidad($valor_id)
    {
        $this->presupuesto = Honorarios_presupuesto::where('presupuesto_id', session('presupuesto'))->where('valor_id', $valor_id)->first();
        $this->cantidad = $this->presupuesto->cantidad;
        $this->dispatchBrowserEvent('tiene-cantidad', []);
    }

    public function guadar_presupuesto()
    {
        if ($this->presupuesto == null) {

            if ($this->valor->calculo) {
                $valor = $this->valor_total;
                $total = $this->valor_total;
                $empleados = null;
            } elseif ($this->valor->empleados) {
                $valor = $this->valor_empleados;
                $total = $this->valor_empleados; 
                $empleados = $this->empleados;
            } else {
                $valor = $this->valor->precio;
                $total = $this->cantidad * $this->valor->precio;
                $empleados = null;
            }

            if($this->valor->valor_minimo > 0){
                if ($this->valor->valor_minimo > $total) {
                    $valor = $this->valor->valor_minimo;
                    $total = $valor;
                }
            }
            
            $presupuesto = Honorarios_presupuesto::create([
                'presupuesto_id' => session('presupuesto'),
                'valor_id' => $this->valor->id,
                'tipo' => $this->valor->tipo,
                'cantidad' => $this->cantidad,
                'empleados' => $empleados,
                'precio' => $valor,
                'total' => $total,
                'user_id' => session('userid'),
            ]);

            if($presupuesto){
                $this->cantidad = 1;
                $this->dispatchBrowserEvent('detalle-agregado', []);
            }
               
        } else {
            $presupuesto = Honorarios_presupuesto::where('id', $this->presupuesto->id)->update([
                'cantidad' => $this->cantidad,
                'total' => $this->cantidad * $this->presupuesto->precio,
            ]);
    
            if($presupuesto){
                $this->cantidad = 1;
                $this->dispatchBrowserEvent('detalle-agregado', []);
            }
        }  
    }

    public function quitar_presupuesto()
    {
        $presupuesto = Honorarios_presupuesto::where('presupuesto_id', session('presupuesto'))->where('valor_id', $this->valor->id)->delete();
    }

    //Guardamos el array de impositivos en la base de datos
    public function generar_presupuesto()
    {   
        $presupuesto_id = session('presupuesto');
        $tareas_agregadas = Honorarios_presupuesto::where('presupuesto_id', session('presupuesto'))->count();

        if ($tareas_agregadas == 0) {
            $this->dispatchBrowserEvent('notify', ['msj' => 'Seleccione al menos una tarea para poder generar el presupuesto.', 'type' => 'danger']); 
        } else {
            $this->cambio_valores();
            session(['presupuesto' => null]);
            $this->reset();

            $this->generar_sesion();
            $this->cargo_impositivos();
            $this->cargo_laborales();
            $this->cargo_otros();
            $this->dispatchBrowserEvent('notify', ['msj' => 'El presupuesto se generó con éxito.', 'type' => 'success']);
            $this->dispatchBrowserEvent('presupuesto', ['presupuesto_id' => $presupuesto_id]);   
        }
    }
}
