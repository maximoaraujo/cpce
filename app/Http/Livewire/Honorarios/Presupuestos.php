<?php

namespace App\Http\Livewire\Honorarios;
use Livewire\WithPagination;

use Livewire\Component;
use App\Models\Honorarios_presupuesto;

class Presupuestos extends Component
{
    use WithPagination;

    public $presupuesto_id;

    public function render()
    {
        $presupuestos = Honorarios_presupuesto::select('presupuesto_id')->groupBy('presupuesto_id')->paginate(10);
        
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
