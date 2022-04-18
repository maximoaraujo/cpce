<div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                            Presupuestos
                        </h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <div class="m-input-icon m-input-icon--left">                               
                                <!-- <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Buscar...">
                                <span class="m-input-icon__icon m-input-icon__icon--left">
                                    <span>
                                        <i class="la la-search"></i>
                                    </span>
                                </span> -->
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin: Datatable -->
                <div class="table-responsive">
                    <table class="table m-table m-table--head-bg-primary table-hover table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>
                                    Impositivos 
                                </th>	
                                <th>
                                    Laborales 
                                </th>	
                                <th>
                                    Otros 
                                </th>
                                <th>
                                    Total 
                                </th>	
                                <th>
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>                               
                            @forelse ($presupuestos as $presupuesto)
                                <tr>
                                    <td>
                                        @php
                                        $total_impositivos = App\Models\Honorarios_presupuesto::where('presupuesto_id', $presupuesto->presupuesto_id)->where('tipo', 'impositivo')->sum('total');
                                        @endphp
                                        ${{number_format($total_impositivos, 2)}}
                                    </td>
                                    <td>
                                        @php
                                        $total_laborales = App\Models\Honorarios_presupuesto::where('presupuesto_id', $presupuesto->presupuesto_id)->where('tipo', 'laboral')->sum('total');
                                        @endphp
                                        ${{number_format($total_laborales, 2)}}
                                    </td>
                                    <td>
                                        @php
                                        $total_otros = App\Models\Honorarios_presupuesto::where('presupuesto_id', $presupuesto->presupuesto_id)->where('tipo', 'otros')->sum('total');
                                        @endphp
                                        ${{number_format($total_otros, 2)}}
                                    </td>
                                    <td>
                                        ${{number_format($total_impositivos + $total_laborales + $total_otros, 2)}}
                                    </td>
                                    <td>
                                        <a href="{{ route('honorarios.presupuesto', ['presupuesto' => $presupuesto->presupuesto_id]) }}" target="_blank" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Reimprimir">
                                            <i class="la la-print"></i>
                                        </a>
                                        <button wire:click="presupuestoID('{{$presupuesto->presupuesto_id}}')" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar">
                                            <i class="la la-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    @include('layouts.modales.modal-eliminar-presupuesto')
                    <!--end: Datatable -->
                    {{$presupuestos->links('vendor.pagination.bootstrap-4')}}	              
                </div>
            </div>
        </div>				
    </div>
</div>
@section('js')
<script>
window.addEventListener('modal-eliminar-up', event => {
    $("#m_eliminar_presupuesto").modal('show');
});

window.addEventListener('modal-eliminar-down', event => {
    $("#m_eliminar_presupuesto").modal('hide');
})
</script>
@endsection