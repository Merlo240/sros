@extends('adminlte::page')

@section('title', 'Cloaca')
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
#mapid { min-height: 300px; }
</style>
@stop
@section('content_header')
    <h1>Editar Obra</h1>
@stop

@section('content')
@section('plugins.Select2', true)
<div class="card">
    <div class="card-body">
        {!! Form::model($cloaca,['route'=>['admin.cloaca.update',$cloaca],'method'=>'put','autocomplete'=>"off"]) !!}
            
        {!! Form::hidden('user_id',auth()->user()->id ,) !!}
    
        <div class="form-group"> 
            {!! Form::label('coordenadas', 'Coordenadas') !!}
            {!! Form::text('coordenadas',null, ['class'=>'form-control coordenadas','placeholder'=>'Coordenadas','readonly']) !!}
            @error('coordenadas')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div> 

        <div class="container" id="mapid"></div>
        
        <div class="form-group">
            {!! Form::label('nombre', 'Nombre') !!}
            {!! Form::text('nombre',null, ['class'=>'form-control','placeholder'=>'Nombre']) !!}
            @error('nombre')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>
 
        <div class="form-group">
            {!! Form::label('metros', 'Metros') !!}
            {!! Form::text('metros',null, ['class'=>'form-control metros','placeholder'=>'Metros','readonly']) !!}
            @error('metros')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>
        <div class="form-group">
            {!! Form::label('ancho', 'Ancho') !!}
            {!! Form::text('ancho',null, ['class'=>'form-control','placeholder'=>'Ingrese el Ancho']) !!}
            @error('ancho')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('typo', 'Typo') !!}
            {!! Form::text('typo',null, ['class'=>'form-control typo','placeholder'=>'typo','readonly']) !!}
            @error('typo')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>
        
        <div class="form-group">
            {!! Form::label('status_id', 'Estado') !!}
            {!! Form::select('status_id',$status,null, ['class'=>'form-control']) !!}
        
            @error('status_id')
            <small class="malr text-danger">*{{$message}}</small>
        @enderror
        </div>

        {!! Form::submit('Actualizar Obra', ['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
</div>
@stop



@section('js')
<script src="{{asset('js/app.js')}}"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
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
  title: 'La Obra ha sido Actualizada',
  showConfirmButton: false,
  timer: 2300
})

</script>
@endif

<script>
    
    let inputArray = [{{ $cloaca->coordenadas }}];

function splitArrayIntoChunksOfLen(arr, len) {
  var chunks = [], i = 0, n = arr.length;
  while (i < n) {
    chunks.push(arr.slice(i, i += len));
  }
  return chunks;
}

let inputRevece =inputArray;
let ubic =splitArrayIntoChunksOfLen(inputRevece,2);

let ubics=inputArray.slice(0,2).reverse();
let ubics1=inputArray.slice(0,4);

let map = L.map('mapid').setView(ubics,17);
   
    L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/mapabase_gris@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
        attribution: '<a href="http://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> | <a href="http://www.ign.gob.ar/AreaServicios/Argenmap/IntroduccionV2" target="_blank">Instituto Geográfico Nacional</a> + <a href="http://www.osm.org/copyright" target="_blank">OpenStreetMap</a>',
        minZoom: 3,
        maxZoom: 18}).addTo(map);
     
    
geojsony = {
    "properties": {},
    "type": "Feature",
    "geometry": {
        "type": "LineString",
        "coordinates":
         ubic
        
    }
}
console.log(geojsony);

var drawnItems = new L.geoJson(geojsony).addTo(map);

      var drawControl = new L.Control.Draw({
        draw: {
            polyline: true,
            polygon: false,
            circle: false,
            marker: false,
            rectangle: false,
            circlemarker:false,
        },
        edit: {
          featureGroup: drawnItems,
        },
      });

      map.addControl(drawControl);
    



      map.on(L.Draw.Event.EDITED, function (e) {
      var type = e.layerType
    var layer = e.layers;
    layer.eachLayer(function (layer) {

 
    let coords = layer.getLatLngs();
    let length = 0;
    for (let i = 0; i < coords.length - 1; i++) {
      length += coords[i].distanceTo(coords[i + 1]);
    }
    let coordenadas  = layer.toGeoJSON().geometry.coordinates.toString();
	let typo = layer.toGeoJSON().geometry.type.toString();

     $('.coordenadas').val(coordenadas);
		$('.metros').val(length.toFixed());

    
    });


});


</script>
<script>
    $(document).ready( function () {
     $('#calle_id').select2({
       });
    });
</script>
@stop