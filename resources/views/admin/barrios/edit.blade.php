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
#mapid { min-height: 300px; }
</style>
@stop

@section('content_header')
<h1>Editar {{$barrio->name}}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::model($barrio,['route'=>['admin.barrios.update',$barrio],'method'=>'put','autocomplete'=>"off"]) !!}
            
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name',null, ['class'=>'form-control','placeholder'=>'ingrese el Barrio']) !!}
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

                <div class="container" id="mapid"></div>

                {!! Form::submit('Actualizar Barrio', ['class'=>'btn btn-primary']) !!}
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
  title: 'El barrio ha sido Actualizado',
  showConfirmButton: false,
  timer: 2300
})

</script>
@endif

<script>
    
    let inputArray = [{{ $barrio->coordenadas }}];

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

let map = L.map('mapid').setView(ubics,15);
   
    L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/mapabase_gris@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
        attribution: '<a href="http://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> | <a href="http://www.ign.gob.ar/AreaServicios/Argenmap/IntroduccionV2" target="_blank">Instituto Geográfico Nacional</a> + <a href="http://www.osm.org/copyright" target="_blank">OpenStreetMap</a>',
        minZoom: 3,
        maxZoom: 18}).addTo(map);
   
        axios.get('{{ route('api.places_barrio.index') }}')
        .then(function (response) {
        console.log(response.data);
       var markery = L.geoJSON(response.data,{
	style: function (feature) {
		return {color: feature.properties.color};
	},
            pointToLayer: function(geoJsonPoint,latlng) {
                return L.Polyline(latlng);
            }
        })
        .bindPopup(function(layer) {
            //return layer.feature.properties.map_popup_content;
     return ('<div class="my-2"><strong>Nombre</strong> : '+layer.feature.properties.Nombre+'</div> <div class="my-2"><strong>Metros</strong> : '+layer.feature.properties.Metros+'</div><div class="my-2"><strong>Ancho</strong> : '+layer.feature.properties.Ancho+'</div><div class="my-2"><strong>Ancho</strong> : '+layer.feature.properties.Ancho+'</div><div class="my-2"><strong>Estado</strong> : '+'<div class="btn btn-'+ layer.feature.properties.color +' btn-sm">'+layer.feature.properties.Estado+'</div>'+'</div><div class="my-2"><strong>Tiempo</strong> : '+layer.feature.properties.Tiempo+'</div><div class="my-2"><strong>Fecha_Creacion</strong> : '+layer.feature.properties.Fecha_Creacion+'</div><div class="my-2"><strong>Fecha_Modificacion</strong>: '+layer.feature.properties.Fecha_Modificacion+'</div>');
}).addTo(map);
    
    })
    .catch(function (error) {
        console.log(error);
    });
    
geojsony = {
    "properties": {},
    "type": "Feature",
    "geometry": {
        "type": "Polygon",
        "coordinates":
         [ubic]
        
    }
}



var drawnItems = new L.geoJson(geojsony).addTo(map);

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