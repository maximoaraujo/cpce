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
            <label class="m-checkbox">
                <input type="checkbox" wire:click="otroID({{$otro->id}})">
                {{$otro->descripcion}} 
                <span></span>
                <strong class = "text-danger">(${{number_format($otro->precio, 2)}})</strong>
            </label>
            @empty
            @endforelse
        </div>   
    @empty
    Sin otros valores...
    @endforelse 
</div>