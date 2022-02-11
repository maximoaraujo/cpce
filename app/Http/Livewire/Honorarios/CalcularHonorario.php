<?php

namespace App\Http\Livewire\Honorarios;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

use Livewire\Component;
use App\Models\Valores;
use App\Models\Honorarios_presupuesto;

class CalcularHonorario extends Component
{
    public $estado, $buscar;
    public $impositivo_id, $laboral_id, $otro_id;
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
        //Corroboramos si tildo o destildo la tarea, si la tilda almacenamos el id de la tarea en un array,
        //caso contrario lo eliminamos del array de tareas
        if (in_array($this->impositivo_id, $this->tareas_impositivas)) {
            $clave = array_search($this->impositivo_id, $this->tareas_impositivas);
            unset($this->tareas_impositivas[$clave]);
        } else {
            array_push($this->tareas_impositivas, json_encode($this->impositivo_id)); 
        }         
    }

    //Click en una descripción de laborales
    public function laboralID($laboral_id)
    {  
        $this->laboral_id = $laboral_id;
        //Corroboramos si tildo o destildo la tarea, si la tilda almacenamos el id de la tarea en un array,
        //caso contrario lo eliminamos del array de tareas
        if (in_array($this->laboral_id, $this->tareas_laborales)) {
            $clave = array_search($this->laboral_id, $this->tareas_laborales);
            unset($this->tareas_laborales[$clave]);
        } else {
            array_push($this->tareas_laborales, json_encode($this->laboral_id)); 
        }         
    }

    //Click en una descripción de otros
    public function otroID($otro_id)
    {  
        $this->otro_id = $otro_id;
        //Corroboramos si tildo o destildo la tarea, si la tilda almacenamos el id de la tarea en un array,
        //caso contrario lo eliminamos del array de tareas
        if (in_array($this->otro_id, $this->tareas_otros)) {
            $clave = array_search($this->otro_id, $this->tareas_otros);
            unset($this->tareas_otros[$clave]);
        } else {
            array_push($this->tareas_otros, json_encode($this->otro_id)); 
        }         
    }

    //Guardamos el array de impositivos en la base de datos
    public function guardar()
    {   
        if (($this->tareas_impositivas == null)&&($this->tareas_laborales == null)&&($this->tareas_otros == null)) {
            $this->dispatchBrowserEvent('notify', ['msj' => 'Seleccione al menos una tarea para poder generar el presupuesto.', 'type' => 'danger']);
        } else {
            $presupuesto_id = session('presupuesto');
            Honorarios_presupuesto::create([
                'presupuesto_id' => session('presupuesto'),
                'impositivos' => json_encode($this->tareas_impositivas),
                'laborales' => json_encode($this->tareas_laborales),
                'otros' => json_encode($this->tareas_otros)
            ]);
    
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
