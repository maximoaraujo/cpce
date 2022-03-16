<div class="m-form__group form-group">
    @forelse($subtipos_otros as $subtipo)  
        <label class = "mt-1">
            <strong>{{strtoupper($subtipo)}}</strong>
        </label>
        @php
        $otros = App\Models\Valores::where('subtipo', $subtipo)->where('descripcion', 'LIKE', '%'.$buscar.'%')->get();
        @endphp
        <div class="m-checkbox-list">
            @forelse($otros as $otro)
            @php
            $insertado = App\Models\Honorarios_presupuesto::where('presupuesto_id', session('presupuesto'))->where('valor_id', $otro->id)->count();        
            @endphp
            <label class="m-checkbox">
                <input type="checkbox" wire:click="otroID({{$otro->id}})" @if($insertado) checked @endif>
                {{$otro->descripcion}} 
                <span></span>
                <strong class = "text-danger">
                    @if(($otro->cantidad)&&($cantidad > 0))
                    {{$cantidad}}
                    <a href = "#"></a> 
                    x
                    @endif
                    (${{number_format($otro->precio, 2)}})
                </strong>
            </label>
            @empty
            @endforelse
        </div>   
    @empty
    Sin otros valores...
    @endforelse 
</div>