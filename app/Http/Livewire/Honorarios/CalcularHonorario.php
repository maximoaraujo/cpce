<?php

namespace App\Http\Livewire\Honorarios;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use Livewire\Component;
use App\Models\Valores;
use App\Models\Honorarios_presupuesto;

class CalcularHonorario extends Component
{
    public $presupuesto, $estado, $buscar;
    public $check_impositivo, $impositivo_id, $laboral_id, $otro_id, $cantidad = 1;
    public $valor;
    public $subtipos_impositivo = [];
    public $subtipos_laboral = [];
    public $subtipos_otros = [];
    public $tareas_impositivas = [];
    public $tareas_laborales = [];
    public $tareas_otros = [];

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

        $this->valor = Valores::find($this->impositivo_id);
        $agregado = Honorarios_presupuesto::where('valor_id', $this->valor->id)->where('presupuesto_id', session('presupuesto'))->count();

        if ($this->valor->cantidad) {
            if ($agregado == 0) {
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

    //Click en una descripción de laborales
    public function laboralID($laboral_id)
    {  
        $this->laboral_id = $laboral_id;

        $this->valor = Valores::find($this->laboral_id);
        $agregado = Honorarios_presupuesto::where('valor_id', $this->valor->id)->where('presupuesto_id', session('presupuesto'))->count();

        if ($this->valor->cantidad) {
            if ($agregado == 0) {
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

    //Click en una descripción de otros
    public function otroID($otro_id)
    {  
        $this->otro_id = $otro_id;
        
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

    public function editarCantidad($valor_id)
    {
        $this->presupuesto = Honorarios_presupuesto::where('presupuesto_id', session('presupuesto'))->where('valor_id', $valor_id)->first();
        $this->cantidad = $this->presupuesto->cantidad;
        $this->dispatchBrowserEvent('tiene-cantidad', []);
    }

    public function guadar_presupuesto()
    {
        if ($this->presupuesto == null) {
            $presupuesto = Honorarios_presupuesto::create([
                'presupuesto_id' => session('presupuesto'),
                'valor_id' => $this->valor->id,
                'tipo' => $this->valor->tipo,
                'cantidad' => $this->cantidad,
                'precio' => $this->valor->precio,
                'total' => $this->cantidad * $this->valor->precio,
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
