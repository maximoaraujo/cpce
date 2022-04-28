@extends('layouts.app')

@section('content')
<div class="m-content">
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="m-portlet__head-text">
                        Tablas utilizadas para los cálculos
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                
            </div>
        </div>
        <div class="m-portlet__body">
            @if($tabla == "impositivas")
            <img src = "{{ asset('assets/images/impositivos.png') }}">
            @else
            <img src = "{{ asset('assets/images/laborales.png') }}">
            @endif
        </div>
    </div>				
</div>
@endsection