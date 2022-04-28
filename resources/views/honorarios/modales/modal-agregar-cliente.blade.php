<div class="modal fade" data-keyboard="false" data-backdrop="static" id="modal-cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group m-form__group row">
                    <div class="col-lg-9">
                        <label>
                            Nombre:
                        </label>
                        <input type="text" wire:model.defer="nombre" class="uppercase form-control m-inputt">
                        @error('nombre') 
                        <span class="m-form__help" style = "color:red;font-size:12px;">{{ $message }}</span> 
                        @enderror
                    </div>
                    <div class="col-lg-3">
                        <label>
                            CUIT:
                        </label>
                        <input type="text" wire:model.defer="cuit" class="uppercase form-control m-inputt">
                        @error('cuit') 
                        <span class="m-form__help" style = "color:red;font-size:12px;">{{ $message }}</span> 
                        @enderror
                    </div>
                    <div class="col-lg-12 mt-3">
                        <label>
                            Dirección:
                        </label>
                        <input type="text" wire:model.defer="direccion" class="uppercase form-control m-inputt">
                    </div>
                    <div class="col-lg-6 mt-3">
                        <label for="exampleSelect1">
                            Provincia
                        </label>
                        <select class="form-control m-input" wire:model="provincia">
                            <option value = "null" selected disabled>Seleccionar...</option>
                            @forelse($provincias as $provincia)
                            <option value = "{{$provincia->id}}">{{$provincia->nombre}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    @if($provincia != null)
                    <div class="col-lg-6 mt-3">
                        <label for="exampleSelect1">
                            Localidad
                        </label>
                        <select class="form-control m-input" wire:model="localidad">
                            <option value = "null" selected disabled>Seleccionar...</option>
                            @forelse($localidades as $localidad)
                            <option value = "{{$localidad->id}}">{{$localidad->nombre}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    @endif
                </div>
            </div>         
            <div class="modal-footer">
                <button type="button" wire:click="guardar_cliente" wire:loading.remove wire:target="guardar_cliente" class="btn btn-success">Guardar</button>
                <div class = "text-sm" wire:loading wire:target="guardar_cliente">
                    Guardando...
                </div>
            </div>
        </div>
    </div>
</div>