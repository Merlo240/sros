@extends('adminlte::page')

@section('title', 'Bacheo')
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
        {!! Form::model($bacheo,['route'=>['admin.bacheos.update',$bacheo],'method'=>'put','autocomplete'=>"off"]) !!}
            
        {!! Form::hidden('user_id',auth()->user()->id ,) !!}
    
        <div class="form-group"> 
            {!! Form::label('coordenadas', 'Coordenadas') !!}
            {!! Form::text('coordenadas',null, ['class'=>'form-control coordenadas','placeholder'=>'Coordenadas','readonly']) !!}
            @error('coordenadas')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>

        <div class="form-group"> 
            {!! Form::label('barrio', 'Barrio') !!}
            {!! Form::text('barrio',null, ['class'=>'form-control textsearch','placeholder'=>'Ingrese el Barrio', 'style'=>'text-transform:uppercase;']) !!}
            @error('barrio')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>  
        <div class="form-group"> 
            {!! Form::label('calle', 'Calle') !!}
            {!! Form::text('calle',null, ['class'=>'form-control textsearch2','placeholder'=>'Ingrese el Calle', 'style'=>'text-transform:uppercase;']) !!}
            @error('calle')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>  

        <div class="container" id="mapid"></div>
        
        <div class="form-group"> 
            {!! Form::label('numeracion', 'Numeracion') !!}
            {!! Form::text('numeracion',null, ['class'=>'form-control','placeholder'=>'Ingrese la numeracion']) !!}
            @error('numeracion')
                <small class="malr text-danger">*{{$message}}</small>
            @enderror
        </div>

        <div class="form-group">
            {!! Form::label('largo', 'Largo') !!}
            {!! Form::text('largo',null, ['class'=>'form-control','placeholder'=>'Ingrese el Largo']) !!}
            @error('largo')
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
            {!! Form::label('mts', 'Mts') !!}
            {!! Form::text('mts',null, ['class'=>'form-control','placeholder'=>'ingrese los Mts']) !!}
            @error('mts')
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
  title: 'La Obra ha sido Actualizada',
  showConfirmButton: false,
  timer: 2300
})

</script>
@endif
<script>
    $(document).ready( function () {
     $('#calle_id').select2({
       });
    });
</script>

<script>
    
    let inputArray = [{{ $bacheo->coordenadas }}];

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
let ubics1=inputArray.slice(0,2);

let map = L.map('mapid').setView(ubics,15);
   
    L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/mapabase_gris@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
        attribution: '<a href="http://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> | <a href="http://www.ign.gob.ar/AreaServicios/Argenmap/IntroduccionV2" target="_blank">Instituto Geográfico Nacional</a> + <a href="http://www.osm.org/copyright" target="_blank">OpenStreetMap</a>',
        minZoom: 3,
        maxZoom: 20}).addTo(map);
   
        axios.get('{{ route('api.places.index') }}')
        .then(function (response) {
        console.log(response.data);
       var markery = L.geoJSON(response.data,{
            pointToLayer: function(geoJsonPoint,latlng) {
            // let idsa =[geoJsonPoint];
            // console.log(idsa)
           let idsas =[latlng];
            var newArray = idsas.filter((item) => item.lat != ubics[0]);
            let sad = newArray
            console.log(sad[0]);
                return L.marker(sad[0]);
            }
        }).addTo(map);
    
    })

geojsony = {
    "properties": {},
    "type": "Feature",
    "geometry": {
        "type": "Point",
        "coordinates":
        ubics1
        
    }
}



var drawnItems = new L.geoJson(geojsony).addTo(map);

      var drawControl = new L.Control.Draw({
        draw: {
            polyline: false,
            polygon: false,
            circle: false,
            marker: true,
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

    let coordenadas  = layer.toGeoJSON().geometry.coordinates.toString();


     $('.coordenadas').val(coordenadas);

    
    });


});


</script>
@stop