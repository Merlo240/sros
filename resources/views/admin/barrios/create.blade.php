
@extends('adminlte::page')

@section('title', 'Barrio')
@section('css')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw-src.css"
    integrity="sha512-vJfMKRRm4c4UupyPwGUZI8U651mSzbmmPgR3sdE3LcwBPsdGeARvUM5EcSTg34DK8YIRiIo+oJwNfZPMKEQyug=="
    crossorigin="anonymous"
  />
<style>
#mapid { min-height: 400px; }
</style>
@stop
@section('content_header')
    <h1>Crear Barrio</h1>
@stop

@section('content')
@section('plugins.Sweetalert2', true)
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.barrios.store','autocomplete'=>"off"]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'ingrese el nombre']) !!}
                    @error('name')
                    <small class="malr text-danger">*{{$message}}</small>
                @enderror
                </div>
                <div class="form-group"> 
                    {!! Form::label('coordenadas', 'Coordenadas') !!}
                    {!! Form::text('coordenadas',null, ['class'=>'form-control coordenadas','placeholder'=>'Coordenadas','readonly']) !!}
                    @error('coordenadas')
                        <small class="malr text-danger">*{{$message}}</small>
                    @enderror
                </div> 
                <div class="form-group"> 
                    {!! Form::label('Hex', 'Color') !!}
                    {!! Form::color('Hex',null, ['class'=>'form-control','readonly']) !!}
                    @error('Hex')
                        <small class="malr text-danger">*{{$message}}</small>
                    @enderror
                </div> 
                <div class="container" id="mapid"></div>
                
                <div class="form-group">

                    {!! Form::submit('Crear Barrio', ['class'=>'btn btn-primary formulario-agregar']) !!}
                </div>
               
        {!! Form::close() !!}
    </div>
</div>
@stop

@section('js')
<script src="{{asset('js/app.js')}}"></script>
      <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
          integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
          crossorigin="">
      </script>
        <script
        src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"
        integrity="sha512-ozq8xQKq6urvuU6jNgkfqAmT7jKN2XumbrX1JiB3TnF7tI48DPI4Gy1GXKD/V3EExgAs1V+pRO7vwtS1LHg0Gw=="
        crossorigin="anonymous"
      ></script>

@if (session('mensaje')=='ok')
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'El barrio ha sido guardado',
  showConfirmButton: false,
  timer: 2300
})

</script>


@endif
<script>
    var mapCenter = [
            {{ config('leafletsetup.map_center_latitude') }},
            {{ config('leafletsetup.map_center_longitude') }},
    ];
    var map = L.map('mapid').setView(mapCenter,{{ config('leafletsetup.zoom_level') }});
    L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/mapabase_gris@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
        attribution: '<a href="http://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> | <a href="http://www.ign.gob.ar/AreaServicios/Argenmap/IntroduccionV2" target="_blank">Instituto Geográfico Nacional</a> + <a href="http://www.osm.org/copyright" target="_blank">OpenStreetMap</a>',
        minZoom: 3,
        maxZoom: 18}).addTo(map);

       let drawnItems = L.featureGroup().addTo(map);
      var drawControl = new L.Control.Draw({
        draw: {
            polyline: false,
            polygon: true,
            circle: false,
            marker: false,
            rectangle: false,
            circlemarker:false,
        },
        edit: {
          featureGroup: drawnItems,
          poly: {
                allowIntersection: false
            }
        },
      });
      map.addControl(drawControl);
      map.on(L.Draw.Event.CREATED, function (e) {
		var layer = e.layer; 
        var type = e.layerType,
        layer = e.layer;
        let coordenadas  =  e.layer.toGeoJSON().geometry.coordinates;
    $( document ).ready(function() {
      
        $('.coordenadas').val(coordenadas);
	
    });
		
        console.log("coord : " + e.layer.toGeoJSON().geometry.coordinates);
        console.log()
        
        drawnItems.addLayer(layer);

      });

      
      map.on('draw:edited', function (e) {
      var type = e.layerType
    var layer = e.layers;
    layer.eachLayer(function (layer) {
    let coordenadas  = layer.toGeoJSON().geometry.coordinates.toString();
        $('.coordenadas').val(coordenadas);

    
    });




});

</script>

@stop