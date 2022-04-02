<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-cantidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cantidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" wire:model.defer = "cantidad" class="form-control m-input col-sm-12 float-right">
            </div>
            <div class="modal-footer">
                <button type="button" wire:click = "guadar_presupuesto" wire:loading.remove wire:target="guardar_presupuesto" class="btn btn-primary">Aceptar</button>
                <div wire:loading wire:target="guardar_presupuesto">
                    Guardando...
                </div>
            </div>
        </div>
    </div>
</div>