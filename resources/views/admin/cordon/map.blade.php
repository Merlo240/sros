<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Map</title>
</head>
<body>
    <div class="card">
        <div class="card-body" id="mapid"></div>
    </div>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.4.1/dist/MarkerCluster.Default.css" />
    
    <style>
        #mapid { min-height: 570px; }
    </style>
    
    
   
    <script src="{{asset('js/app.js')}}"></script>
      <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
          integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
          crossorigin="">
      </script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>
  
    <script>
        var mapCenter = [
                {{ config('leafletsetup.map_center_latitude') }},
                {{ config('leafletsetup.map_center_longitude') }},
        ];
        var map = L.map('mapid').setView(mapCenter,{{ config('leafletsetup.zoom_level') }});
       let Base1= L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
    let Base2 = L.tileLayer('https://wms.ign.gob.ar/geoserver/gwc/service/tms/1.0.0/mapabase_gris@EPSG%3A3857@png/{z}/{x}/{-y}.png', {
        attribution: '<a href="http://leafletjs.com" title="A JS library for interactive maps">Leaflet</a> | <a href="http://www.ign.gob.ar/AreaServicios/Argenmap/IntroduccionV2" target="_blank">Instituto Geográfico Nacional</a> + <a href="http://www.osm.org/copyright" target="_blank">OpenStreetMap</a>',
        minZoom: 3,
        maxZoom: 18
    }).addTo(map);
   
        
       
        axios.get('{{ route('api.places_cloaca.index') }}')
        .then(function (response) {
        console.log(response.data);
       var markery = L.geoJSON(response.data,{
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
 
    
  
    </script>
    
    
</body>
</html>
