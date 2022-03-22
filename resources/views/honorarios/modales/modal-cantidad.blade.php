<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-cantidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cantidad</h5>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" wire:model.defer = "cantidad" class="form-control m-input col-sm-12 float-right">
            </div>
            <div class="modal-footer">
                <button type="button" wire:click = "guadar_presupuesto" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>