<div class="m-form__group form-group mt-3">
    @forelse($subtipos_impositivo as $subtipo)  
        <label class = "mt-1">
            <strong>{{strtoupper($subtipo)}}</strong>
        </label>
        @php
        $impositivos = App\Models\Valores::where('subtipo', $subtipo)->where('descripcion', 'LIKE', '%'.$buscar.'%')->get();
        @endphp
        <div class="m-checkbox-list">
            @forelse($impositivos as $impositivo)
            @php
            $insertado = App\Models\Honorarios_presupuesto::where('presupuesto_id', session('presupuesto'))->where('valor_id', $impositivo->id)->count();
            $cantidad = App\Models\Honorarios_presupuesto::where('presupuesto_id', session('presupuesto'))->where('valor_id', $impositivo->id)->pluck('cantidad')->first();         
            @endphp
            <label class="m-checkbox">
                <input type="checkbox" wire:click="impositivoID({{$impositivo->id}})" @if($insertado) checked @endif>
                {{$impositivo->descripcion}} 
                <span>
                </span>
                <strong class = "text-danger">
                    @if(($impositivo->cantidad)&&($cantidad > 0))
                    <a href = "#" wire:click="editarCantidad({{$impositivo->id}})">{{$cantidad}}</a> 
                    x
                    @endif
                    (${{number_format($impositivo->precio, 2)}})
                </strong>
            </label>
            @empty
            @endforelse
        </div>  
    @empty
    Sin valores impositivos...
    @endforelse 
</div>