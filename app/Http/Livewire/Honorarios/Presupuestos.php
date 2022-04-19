<?php

namespace App\Http\Livewire\Honorarios;
use Livewire\WithPagination;

use Livewire\Component;
use App\Models\Presupuesto;
use App\Models\Honorarios_presupuesto;

class Presupuestos extends Component
{
    use WithPagination;

    public $presupuesto_id, $buscar;

    public function render()
    {
        $buscador = $this->buscar;

        $presupuestos = Presupuesto::join('clientes', 'clientes.codigo', 'presupuestos.codigo_cliente')
        ->join('matriculados', 'matriculados.id', 'presupuestos.matriculado_id')
        ->select('presupuestos.id', 'presupuestos.presupuesto_id', 'presupuestos.fecha', 'clientes.nombre as cliente', 'matriculados.nombre as matriculado', 'presupuestos.observaciones')
        ->where(function ($query) use ($buscador) {
            $query->where('clientes.nombre', 'LIKE', '%' .$buscador. '%')
            ->Orwhere('matriculados.nombre', 'LIKE', '%' .$buscador. '%');
        })
        ->orderBy('fecha')->paginate(10);
        
        return view('livewire.honorarios.presupuestos', compact('presupuestos'));
    }

    public function presupuestoID($presupuesto_id)
    {
        $this->presupuesto_id = $presupuesto_id;
        $this->dispatchBrowserEvent('modal-eliminar-up', []);
    }

    public function eliminarPresupuesto()
    {
        Honorarios_presupuesto::where('presupuesto_id', $this->presupuesto_id)->delete();
        $this->reset();
        $this->render();
        $this->dispatchBrowserEvent('modal-eliminar-down', []);
    }
}
