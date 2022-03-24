<!DOCTYPE html>
<html lang="en">
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
        minZoom: 4,
        maxZoom: 19
    }).addTo(map);

// layer.addTo(map);
    // var owsrootUrl = 'https://gisdesa.ciudaddecorrientes.gov.ar:8282/geoserver/wfs_idemcc/wfs?';
	// 	var defaultParameters = {
	// 		service: 'WFS',
	// 		version: '1.1.0',
	// 	    request: 'GetFeature',
	// 		typeName: 'wfs_idemcc:vw_barrios_de_la_ciudad',
    //         format_options : 'getJson',
    //         SrsName : 'EPSG:4326',
    //         MaxFeatures: 200
	// 	};
	// 	var parameters = L.Util.extend(defaultParameters);
 
	// 	var URL = owsrootUrl + L.Util.getParamString(parameters);
		
	// 	var myStyle = {
	// 	    "color": "#ff7800",
	// 	    "weight": 5,
	// 	    "opacity": 0.65
	// 	};
			
	// 	$.ajax({
	// 		url: URL,
	// 		success: function (data) {
	// 			var geoJsonLayer = L.geoJSON(data,{
	// 	 		style: myStyle,
	// 			onEachFeature: function(feature, layer) {
	// 			layer.bindPopup ("<ul><h3>" +feature.properties.STATE_NAME+" </h3><li>Población: " +feature.properties.PERSONS+" Hab</li><li>Superficie: "+feature.properties.LAND_KM+" km2</li></ul>");
	// 				}
	// 			}).addTo(map);
	// 		}
	// 	});
   
    let Bacheo = new L.LayerGroup();
    let Cloaca = new L.LayerGroup();
    let Cordon = new L.LayerGroup();
    let Barrio = new L.LayerGroup();
    let Calle = new L.LayerGroup();


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
        }).addTo(Bacheo);
    
    })
    .catch(function (error) {
        console.log(error);
    });


    axios.get('{{ route('api.places_cloaca.index') }}')
        .then(function (response) {
       var markery = L.geoJSON(response.data,{
        style: function (feature) {
		return {color: feature.properties.hex};
	},
            pointToLayer: function(geoJsonPoint,latlng) {
                return L.Polyline(latlng);
            }
        })
        .bindPopup(function(layer) {
            //return layer.feature.properties.map_popup_content;
     return ('<div class="my-2"><strong>Nombre</strong> : '+layer.feature.properties.Nombre+'</div> <div class="my-2"><strong>Metros</strong> : '+layer.feature.properties.Metros+'</div><div class="my-2"><strong>Ancho</strong> : '+layer.feature.properties.Ancho+'</div><div class="my-2"><strong>Ancho</strong> : '+layer.feature.properties.Ancho+'</div><div class="my-2"><strong>Estado</strong> : '+'<div class="btn btn-'+ layer.feature.properties.color +' btn-sm">'+layer.feature.properties.Estado+'</div>'+'</div><div class="my-2"><strong>Tiempo</strong> : '+layer.feature.properties.Tiempo+'</div><div class="my-2"><strong>Fecha_Creacion</strong> : '+layer.feature.properties.Fecha_Creacion+'</div><div class="my-2"><strong>Fecha_Modificacion</strong>: '+layer.feature.properties.Fecha_Modificacion+'</div>');
}).addTo(Cloaca);
    
    })
    .catch(function (error) {
        console.log(error);
    });
 
    axios.get('{{ route('api.places_cordon.index') }}')
        .then(function (response) {
       var markery = L.geoJSON(response.data,{
            pointToLayer: function(geoJsonPoint,latlng) {
                return L.Polyline(latlng);
            }
        })
        .bindPopup(function(layer) {
            //return layer.feature.properties.map_popup_content;
     return ('<div class="my-2"><strong>Nombre</strong> : '+layer.feature.properties.Nombre+'</div> <div class="my-2"><strong>Metros</strong> : '+layer.feature.properties.Metros+'</div><div class="my-2"><strong>Ancho</strong> : '+layer.feature.properties.Ancho+'</div><div class="my-2"><strong>Ancho</strong> : '+layer.feature.properties.Ancho+'</div><div class="my-2"><strong>Estado</strong> : '+'<div class="btn btn-'+ layer.feature.properties.color +' btn-sm">'+layer.feature.properties.Estado+'</div>'+'</div><div class="my-2"><strong>Tiempo</strong> : '+layer.feature.properties.Tiempo+'</div><div class="my-2"><strong>Fecha_Creacion</strong> : '+layer.feature.properties.Fecha_Creacion+'</div><div class="my-2"><strong>Fecha_Modificacion</strong>: '+layer.feature.properties.Fecha_Modificacion+'</div>');
}).addTo(Cordon);
    
    })
    .catch(function (error) {
        console.log(error);
    });

    axios.get('{{ route('api.places_barrio.index') }}')
        .then(function (response) {
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
     return ('<div class="my-2"><strong>Nombre</strong> : '+layer.feature.properties.Nombre+'</div>');
}).addTo(Barrio);
    
    })
    .catch(function (error) {
        console.log(error);
    });

    axios.get('{{ route('api.places_calle.index') }}')
        .then(function (response) {
       var markery = L.geoJSON(response.data,{
            pointToLayer: function(geoJsonPoint,latlng) {
                return L.Polyline(latlng);
            }
        })
        .bindPopup(function(layer) {
            //return layer.feature.properties.map_popup_content;
     return ('<div class="my-2"><strong>Nombre</strong> : '+layer.feature.properties.Nombre+'</div>');
}).addTo(Calle);
    
    })
    .catch(function (error) {
        console.log(error);
    });
// let layer = L.geoJson(null, {});

// $.getJSON('{{ route('api.places.index') }}',  function (data)  {
//     layer.bindPopup(function(layer) {
//             //return layer.feature.properties.map_popup_content;
//             return ('<div class="my-2"><strong>Barrio</strong> : '+layer.feature.properties.Barrio+'</div> <div class="my-2"><strong>Calle</strong> : '+layer.feature.properties.Calle+'</div><div class="my-2"><strong>Numeracion</strong> : '+layer.feature.properties.Numeracion+'</div><div class="my-2"><strong>Largo</strong> : '+layer.feature.properties.Largo+'</div><div class="my-2"><strong>Ancho</strong> : '+layer.feature.properties.Ancho+'</div><div class="my-2"><strong>Mts</strong> : '+layer.feature.properties.Mts+'</div><div class="my-2"><strong>Estado</strong> : '+'<div class="btn btn-'+ layer.feature.properties.color +' btn-sm">'+layer.feature.properties.Estado+'</div>'+'</div><div class="my-2"><strong>Tiempo</strong> : '+layer.feature.properties.Tiempo+'</div><div class="my-2"><strong>Fecha_Creacion</strong> : '+layer.feature.properties.Fecha_Creacion+'</div><div class="my-2"><strong>Fecha_Modificacion</strong>: '+layer.feature.properties.Fecha_Modificacion+'</div>');
//         }).addData(data);
// });

// layer.addTo(BarriosCapital);


            var capas_base = {
                "openstreetmap": Base1,
                "Gis": Base2
            };
            var capas_tematicas = {
                "Bacheo": Bacheo,
                "Cloaca Social ": Cloaca,
                "Cordon Cuneta" : Cordon,
                "Barrios":Barrio,
                "Calles":Calle
            
            };
            
            L.control.layers(capas_base, capas_tematicas).addTo(map);
    </script>
    
    
</body>
</html>
