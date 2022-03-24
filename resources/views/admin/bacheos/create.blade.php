@extends('adminlte::page')

@section('title', 'Bacheo')

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
  #mapid { min-height: 400px; }
</style>
@stop

@section('content_header')
    <h1>Agregar Obra</h1>
@stop

@section('content')
@section('plugins.Select2', true)
<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.bacheos.store','name'=>'bacheo']) !!}
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
                    {!! Form::text('calle',null, ['class'=>'form-control calle textsearch2','placeholder'=>'Ingrese el Calle', 'style'=>'text-transform:uppercase;']) !!}
                    @error('calle')
                        <small class="malr text-danger">*{{$message}}</small>
                    @enderror
                </div>  

                <div class="container" id="mapid"></div>

                <div class="form-group"> 
                    {!! Form::label('numeracion', 'Numeracion') !!}
                    {!! Form::text('numeracion',null, ['class'=>'form-control numeracion','placeholder'=>'Ingrese la numeracion']) !!}
                    @error('numeracion')
                        <small class="malr text-danger">*{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('largo', 'Largo') !!}
                    {!! Form::text('largo',null, ['class'=>'form-control','placeholder'=>'Ingrese el Largo','onkeyup '=>'Suma()']) !!}
                    @error('largo')
                        <small class="malr text-danger">*{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('ancho', 'Ancho') !!}
                    {!! Form::text('ancho',null, ['class'=>'form-control','placeholder'=>'Ingrese el Ancho','onkeyup '=>'Suma()']) !!}
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
       $(document).ready( function () {
        $('#calle_id').select2({
          });
       });
 </script>
 <script>
    var mapCenter = [
            {{ config('leafletsetup.map_center_latitude') }},
            {{ config('leafletsetup.map_center_longitude') }},
    ];
    var map = L.map('mapid').setView(mapCenter,{{ config('leafletsetup.zoom_level') }});
  L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/mapabase_gris@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
        attribution: '<a href="http://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> | <a href="http://www.ign.gob.ar/AreaServicios/Argenmap/IntroduccionV2" target="_blank">Instituto Geográfico Nacional</a> + <a href="http://www.osm.org/copyright" target="_blank">OpenStreetMap</a>',
        minZoom: 3,
        maxZoom: 18
    }).addTo(map);

    axios.get('{{ route('api.places.index') }}')
        .then(function (response) {
        //console.log(response.data);
       var markery = L.geoJSON(response.data,{
            pointToLayer: function(geoJsonPoint,latlng) {
                return L.marker(latlng);
            }
        })
        .bindPopup(function(layer) {
            //return layer.feature.properties.map_popup_content;
            return ('<div class="my-2"><strong>Barrio</strong> : '+layer.feature.properties.Barrio+'</div> <div class="my-2"><strong>Calle</strong> : '+layer.feature.properties.Calle+'</div><div class="my-2"><strong>Numeracion</strong> : '+layer.feature.properties.Numeracion+'</div><div class="my-2"><strong>Largo</strong> : '+layer.feature.properties.Largo+'</div><div class="my-2"><strong>Ancho</strong> : '+layer.feature.properties.Ancho+'</div><div class="my-2"><strong>Mts</strong> : '+layer.feature.properties.Mts+'</div><div class="my-2"><strong>Estado</strong> : '+'<div class="btn btn-'+ layer.feature.properties.color +' btn-sm">'+layer.feature.properties.Estado+'</div>'+'</div><div class="my-2"><strong>Tiempo</strong> : '+layer.feature.properties.Tiempo+'</div><div class="my-2"><strong>Fecha_Creacion</strong> : '+layer.feature.properties.Fecha_Creacion+'</div><div class="my-2"><strong>Fecha_Modificacion</strong>: '+layer.feature.properties.Fecha_Modificacion+'</div>');
        }).addTo(map);
    
    })
    .catch(function (error) {
        console.log(error);
    });

    drawnItems = L.featureGroup().addTo(map);
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
      map.on(L.Draw.Event.CREATED, function (e) {
		var layer = e.layer; 
        var type = e.layerType,
        layer = e.layer;

        let coordenadas  =  e.layer.toGeoJSON().geometry.coordinates;
        let ubics=coordenadas.slice(0,2).reverse();
        $.getJSON("http://nominatim.openstreetmap.org/reverse?format=json&addressdetails=0&zoom=18&lat=" + ubics[0] + "&lon=" + ubics[1] + "&json_callback=?",
                    function (response) {
                        let asa =response.display_name;
                        let info = asa.split(',');
                        console.log(isNaN(info[0]))     
                        console.log(asa.split(','));

                        if (!isNaN(info[0])) {
                            $('.calle').val(info[1]);
                            $('.numeracion').val(info[0]);
                        }else{
                            $('.calle').val(info[0]);
                            $('.numeracion').val();
                            console.log("calle"+info[0]);
                            
                        }
                    }
                );
        // console.log(ubics[0]+','+ubics[1]);
        // $.getJSON("http://proyectpractica3.test/api/places_calle/"+ubics[0]+','+ubics[1],
        //             function (response) {
        //                console.log(response);
        //             }
        //         );
        
    $( document ).ready(function() {
      
        $('.coordenadas').val(coordenadas);
	
    });
		
        console.log("coord : " + e.layer.toGeoJSON().geometry.coordinates);
        
        drawnItems.addLayer(layer);

      });

      map.on(L.Draw.Event.EDITED, function (e) {
      var type = e.layerType
    var layer = e.layers;
    layer.eachLayer(function (layer) {

    let coordenadass  = layer.toGeoJSON().geometry.coordinates.toString();
    
        let ubicss=layer._latlng;
        $.getJSON("http://nominatim.openstreetmap.org/reverse?format=json&addressdetails=0&zoom=18&lat=" + ubicss.lat + "&lon=" + ubicss.lng + "&json_callback=?",
                    function (response) {
                        let asa =response.display_name;
                        let info = asa.split(',');
                        console.log(isNaN(info[0]))     
                        console.log(asa.split(','));

                        if (!isNaN(info[0])) {
                            $('.calle').val(info[1]);
                            $('.numeracion').val(info[0]);
                        }else{
                            $('.calle').val(info[0]);
                            $('.numeracion').val();
                            
                            
                        }
                    }
                );
        $('.coordenadas').val(coordenadass);
    });




});
   



</script>
<script>
    function Suma() {
          var largo = document.bacheo.largo.value;
          var ancho = document.bacheo.ancho.value;
        try{
            
            largo = (Number.isNaN(Number.parseFloat(largo)))? 0 : Number.parseFloat (largo);
           ancho = (Number.isNaN(Number.parseFloat(ancho)))? 0 : Number.parseFloat (ancho);
             document.bacheo.mts.value = largo*ancho;
         }
         catch(e) {}
      }
    
</script>
@stop