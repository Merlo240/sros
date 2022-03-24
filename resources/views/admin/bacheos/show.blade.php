@extends('adminlte::page')

@section('title', 'Bacheo')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
      integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
      crossorigin=""/>
    <style>
      #mapid { min-height: 583px; }
    </style>
@stop
@section('content_header')
    <h1>Detalles de Obra</h1>
@stop

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Detalles</div>
            <div class="card-body">
                <table class="table table-striped display compact">
                    <tbody>
                        <tr><td><strong>id:</strong></td><td>{{ $bacheo->id }}</td></tr>
                        <tr><td><strong>Barrio:</strong> </td><td>{{$bacheo->barrio}}</td></tr>
                        <tr><td><strong>Calle:</strong></td><td>{{$bacheo->calle}}</td></tr>
                        <tr><td><strong>Numeracion:<strong></td><td>{{ $bacheo->numeracion }}</td></tr>
                        <tr><td><strong>Largo:</strong></td><td>{{ $bacheo->largo }}</td></tr>
                        <tr><td><strong>Ancho:</strong></td><td>{{ $bacheo->ancho }}</td></tr>
                        <tr><td><strong>Mts:</strong></td><td>{{ $bacheo->mts }}</td></tr>
                        <tr><td><strong>Estado:</strong></td><td><div class="btn btn-{{$bacheo->status->color}} btn-sm">{{$bacheo->status->name}}</div></td></tr>
                        <tr><td><strong>Tiempo:</strong></td><td>{{$bacheo->created_at->diffForHumans()}}</td></tr>
                    </tbody>
                   
                </table>
                
            </div>
            <td><a href="{{route('admin.bacheos.edit',$bacheo)}}" class="btn btn-secondary">Editar</a></td>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Ubicacion</div>
            <div class="card-body" id="mapid"></div>
        </div>
    </div>
</div>
</div>

@stop


@section('js')

<!-- Leaflet JavaScript -->
      <!-- Make sure you put this AFTER Leaflet's CSS -->
      <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
          integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
          crossorigin="">
      </script>

<script>

let inputArray = [{{ $bacheo->coordenadas }}];
let ubics=inputArray.slice(0,2).reverse();

   var map = L.map('mapid').setView(ubics,{{ config('leafletsetup.detail_zoom_level') }});

   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    let point = L.marker(ubics, {color: 'red'}).addTo(map)
map.fitBounds(point.getBounds());

</script>
@stop