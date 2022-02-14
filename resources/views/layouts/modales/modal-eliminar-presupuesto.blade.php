<div class="modal fade" id="m_eliminar_presupuesto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Eliminar
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        &times;
                    </span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de realizar esta acción? </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger md-close" data-dismiss="modal" aria-hidden="true">No</button>
                <button class="btn btn-success md-close" wire:click="eliminarPresupuesto">Si, estoy seguro</button>
            </div>
        </div>
    </div>
</div>