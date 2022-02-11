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
            <label class="m-checkbox">
                <input type="checkbox" wire:click="laboralID({{$laboral->id}})">
                {{$laboral->descripcion}} 
                <span></span>
                <strong class = "text-danger">(${{number_format($laboral->precio, 2)}})</strong>
            </label>
            @empty
            @endforelse
        </div>   
    @empty
    Sin valores laborales...
    @endforelse 
</div>