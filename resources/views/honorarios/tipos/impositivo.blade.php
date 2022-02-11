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
            <label class="m-checkbox">
                <input type="checkbox" wire:click="impositivoID({{$impositivo->id}})">
                {{$impositivo->descripcion}} 
                <span></span>
                <strong class = "text-danger">(${{number_format($impositivo->precio, 2)}})</strong>
            </label>
            @empty
            @endforelse
        </div>   
    @empty
    Sin valores impositivos...
    @endforelse 
</div>