<div class="m-form__group form-group">
    @forelse($subtipos_laboral as $subtipo)  
        <label class = "mt-1">
            <strong>{{strtoupper($subtipo)}}</strong>
        </label>
        @php
        $laborales = App\Models\Valores::where('subtipo', $subtipo)->where('descripcion', 'LIKE', '%'.$buscar.'%')->get();
        @endphp
        <div class="m-checkbox-list">
            @forelse($laborales as $laboral)
            @php
            $insertado = App\Models\Honorarios_presupuesto::where('presupuesto_id', session('presupuesto'))->where('valor_id', $laboral->id)->count(); 
            $cantidad = App\Models\Honorarios_presupuesto::where('presupuesto_id', session('presupuesto'))->where('valor_id', $laboral->id)->pluck('cantidad')->first();                
            @endphp
            <label class="m-checkbox">
                <input type="checkbox" wire:click="laboralID({{$laboral->id}})" @if($insertado) checked @endif>
                {{$laboral->descripcion}} 
                <span></span>
                <strong class = "text-danger">
                    @if(($laboral->cantidad)&&($cantidad > 0))
                    <a href = "#" wire:click="editarCantidad({{$laboral->id}})">{{$cantidad}}</a> 
                    x
                    @endif
                    @if($laboral->empleados)
                        @php
                        $total = App\Models\Honorarios_presupuesto::where('presupuesto_id', session('presupuesto'))->where('valor_id', $laboral->id)->pluck('total')->first();         
                        @endphp
                        @if($cantidad > 0)
                        <span class = "text-danger">(${{number_format($total, 2)}})</span>
                        @endif
                    @else
                    (${{number_format($laboral->precio, 2)}})
                    @endif
                    @if($laboral->valor_minimo > 0)
                    (Valor mínimo ${{$laboral->valor_minimo}})
                    @endif
                </strong>
            </label>
            @empty
            @endforelse
        </div>   
    @empty
    Sin valores laborales...
    @endforelse 
</div>