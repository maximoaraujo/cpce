<div>
    @include('honorarios.modales.modal-cantidad')
    @include('honorarios.modales.modal-calculo')
    @include('honorarios.modales.modal-empleados')
    <div class="container" style = "margin-top:55px;position:relative;min-height:500px;">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Honorarios
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ route('home') }}" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <span class="m-nav__link">
                            <span class="m-nav__link-text">
                                Calcular honorarios
                            </span>
                        </span>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">                
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tabs">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a wire:click="$set('estado',1)"  class="nav-link m-tabs__link {{($estado == 1) ? 'active': ''}}" data-toggle="tab" href="#" role="tab">
                                        <i class="la la-money"></i>
                                        Impositivo
                                    </a>
                                </li>                               
                                <li class="nav-item m-tabs__item">
                                    <a wire:click="$set('estado',2)"  class="nav-link m-tabs__link {{($estado == 2) ? 'active': ''}}" data-toggle="tab" href="#" role="tab">
                                        <i class="la la-users"></i>
                                        Laboral
                                    </a>
                                </li>                                
                                <li class="nav-item m-tabs__item">
                                    <a wire:click="$set('estado',3)"  class="nav-link m-tabs__link {{($estado == 3) ? 'active': ''}}" data-toggle="tab" href="#" role="tab">
                                        <i class="la la-folder-open"></i>
                                        Otros
                                    </a>
                                </li>
                                <li>
                                    <button wire:click="generar_presupuesto" class="btn btn-danger m-btn m-btn--icon mt-3" wire:loading.remove wire:target="guardar">
                                        <span>
                                            <span>
                                                Generar presupuesto
                                            </span>
                                            <i class="la la-file-pdf-o"></i>
                                        </span>
                                    </button>
                                    <div class = "mt-4" wire:loading wire:target="guardar">
                                        <div class="m-loader" style="width: 30px; display: inline-block;"></div>
                                        <small class = "text-metal">generando presupuesto...</small>
                                    </div>
                                </li>
                            </ul>                           
                        </div>
                        <div class="m-portlet__head-tools">
                            <input type="text" wire:model = "buscar" class="form-control m-input col-sm-12 float-right" placeholder="Buscar...">
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        @if($estado == 1)
                            <div class="tab-content">
                                @include('honorarios.tipos.impositivo')
                            </div> 
                        @elseif($estado == 2)
                            <div class="tab-content">
                                @include('honorarios.tipos.laboral')
                            </div>                           
                        @elseif($estado == 3)
                            <div class="tab-content">
                                @include('honorarios.tipos.otros') 
                            </div> 
                            <hr style="border-top: dashed 1px;color:#EAEAEA;">
                        @endif
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>
</div>
@section('js')
<script>
window.addEventListener('tiene-cantidad', event => {
    $("#modal-cantidad").modal("show");
});

window.addEventListener('detalle-agregado', event => {
    $("#modal-cantidad").modal("hide");
});

window.addEventListener('presupuesto', event => {
    window.open('/honorarios/imprimir-presupuesto/'+event.detail.presupuesto_id, '_blank');
});

window.addEventListener('tiene-calculo', event => {
    $("#modal-calculo").modal("show");
});

window.addEventListener('calculo-ok', event => {
    $("#modal-calculo").modal("hide");
});

window.addEventListener('tiene-empleados', event => {
    $("#modal-empleados").modal("show");
});

window.addEventListener('calculo-empleados-ok', event => {
    $("#modal-empleados").modal("hide");
});
</script>
@endsection
