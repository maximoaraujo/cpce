<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-calculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Base de cálculo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="number" wire:model.defer = "importe" class="form-control m-input col-sm-12 float-right" placeholder="Ingrese un importe">         
            </div>
            <div class="modal-footer">
                <button type="button" wire:click = "calcular" wire:loading.remove wire:target="calcular" class="btn btn-primary">Aceptar</button>
                <div class = "text-sm" wire:loading wire:target="calcular">
                    Calculando...
                </div>
            </div>
        </div>
    </div>
</div>