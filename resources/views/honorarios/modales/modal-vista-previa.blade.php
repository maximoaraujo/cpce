<div class="modal fade" id="modal_vista_previa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle del presupuesto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <!---->
            <div class="m-section">
                <h3 class="m-section__heading">
                    Tareas impositivas
                </h3>
                <div class="m-section__content">
                    <!--begin::Preview-->
                    <div class="m-demo">
                        <div class="m-demo__preview">
                            <div class="m-list-timeline">
                                <div class="m-list-timeline__items">
                                    @forelse($detalle_impositivos as $detalle)
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge"></span>
                                        <span class="m-list-timeline__text">
                                        {{$detalle->cantidad}} x {{$detalle->valores->descripcion}}   
                                        </span>
                                        <span class="m-list-timeline__time">
                                        {{number_format($detalle->precio, 2)}}
                                        </span>
                                    </div>
                                    @empty
                                    Sin tareas agregadas...
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="m-section__heading">
                    Tareas laborales
                </h3>
                <div class="m-section__content">
                    <!--begin::Preview-->
                    <div class="m-demo">
                        <div class="m-demo__preview">
                            <div class="m-list-timeline">
                                <div class="m-list-timeline__items">
                                    @forelse($detalle_laborales as $detalle)
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge"></span>
                                        <span class="m-list-timeline__text">
                                        {{$detalle->cantidad}} x {{$detalle->valores->descripcion}}   
                                        </span>
                                        <span class="m-list-timeline__time">
                                        {{number_format($detalle->precio, 2)}}
                                        </span>
                                    </div>
                                    @empty
                                    Sin tareas agregadas...
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="m-section__heading">
                    Otras tareas
                </h3>
                <div class="m-section__content">
                    <!--begin::Preview-->
                    <div class="m-demo">
                        <div class="m-demo__preview">
                            <div class="m-list-timeline">
                                <div class="m-list-timeline__items">
                                    @forelse($detalle_otros as $detalle)
                                    <div class="m-list-timeline__item">
                                        <span class="m-list-timeline__badge"></span>
                                        <span class="m-list-timeline__text">
                                        {{$detalle->cantidad}} x {{$detalle->valores->descripcion}}   
                                        </span>
                                        <span class="m-list-timeline__time">
                                        {{number_format($detalle->precio, 2)}}
                                        </span>
                                    </div>
                                    @empty
                                    Sin tareas agregadas...
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class = "float-left">
                <strong>Subtotal: ${{$total}}</strong>
                </div>
            </div>
            <!--/-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" wire:click="generar_presupuesto" class="btn btn-primary">Confirmar y generar</button>
            </div>
        </div>
    </div>
</div>