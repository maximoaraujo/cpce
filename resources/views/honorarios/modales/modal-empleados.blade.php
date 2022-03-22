<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-empleados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Calcular honorarios por empleados</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" wire:model.defer = "empleados" class="form-control m-input col-sm-12 float-right" placeholder="Ingrese cantidad de empleados">  
            </div>
            <div class="modal-footer">
                <button type="button" wire:click = "calcular_empleados" wire:loading.remove wire:target="calcular_empleados" class="btn btn-primary">Aceptar</button>
                <div wire:loading wire:target="calcular_empleados">
                    Calculando...
                </div>
            </div>
        </div>
    </div>
</div>