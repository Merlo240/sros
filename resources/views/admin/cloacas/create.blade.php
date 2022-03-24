@extends('adminlte::page')

@section('title', 'Cloaca')

@section('css')
  <!-- Leaflet CSS -->
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
    <h1>Agregar Obra</h1>
@stop

@section('content')
@section('plugins.Select2', true)
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.cloaca.store','name'=>'cloaca']) !!}
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


                {!! Form::submit('Crear Obra', ['class'=>'btn btn-primary']) !!}
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
      <script src="https://labs.easyblog.it/maps/leaflet-search/src/leaflet-search.js"></script>

@if (session('mensaje')=='ok')
<script>
    Swal.fire({
  position: 'center',
  icon: 'success',
  title: 'La Obra ha sido Creada',
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


        axios.get('{{ route('api.places_cloaca.index') }}')
        .then(function (response) {
        console.log(response.data);
       var markery = L.geoJSON(response.data,{
        style: function (feature) {
		return {color: feature.properties.hex,
            };
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
        drawnItems = L.featureGroup().addTo(map);
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
      map.on(L.Draw.Event.CREATED, function (e) {
		var layer = e.layer; 
        var type = e.layerType,
        layer = e.layer;
    var coords = layer.getLatLngs();
    var length = 0;
    for (var i = 0; i < coords.length - 1; i++) {
      length += coords[i].distanceTo(coords[i + 1]);
    }
  console.log(length.toFixed());
        let coordenadas  =  e.layer.toGeoJSON().geometry.coordinates;
		let typo =  e.layer.toGeoJSON().geometry.type.toString();
    $( document ).ready(function() {
        $('.typo').val(typo);
        $('.coordenadas').val(coordenadas);
		$('.metros').val(length.toFixed());
    });
		
        console.log("coord : " + e.layer.toGeoJSON().geometry.coordinates);
        console.log()
        
        drawnItems.addLayer(layer);

      });

      map.on(L.Draw.Event.EDITED, function (e) {
      var type = e.layerType
    var layer = e.layers;
    layer.eachLayer(function (layer) {

		console.log(layer.toGeoJSON().geometry.coordinates.toString());
    let cont = $('.typo').val();
        if (cont === 'Point') {
            layer.bindPopup(name);
        }
		if (cont ==='LineString') {
    var coords = layer.getLatLngs();
    var length = 0;
    for (var i = 0; i < coords.length - 1; i++) {
      length += coords[i].distanceTo(coords[i + 1]);
    }
  }
    let coordenadas  = layer.toGeoJSON().geometry.coordinates.toString();
	let typo = layer.toGeoJSON().geometry.type.toString();

        $('.typo').val(typo);
        $('.coordenadas').val(coordenadas);
		$('.metros').val(length.toFixed());

    
    });




});

</script>

@stop