@extends('adminlte::page')

@section('title', 'Cloaca')
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
                        <tr><td><strong>id:</strong></td><td>{{ $cloaca->id }}</td></tr>
                        <tr><td><strong>Nombre:</strong> </td><td>{{$cloaca->nombre}}</td></tr>
                        <tr><td><strong>Metros:</strong></td><td>{{$cloaca->metros}}</td></tr>
                        <tr><td><strong>Coordenadas:<strong></td><td>{{ $cloaca->coordenadas }}</td></tr>
                        <tr><td><strong>Typo:<strong></td><td>{{ $cloaca->typo }}</td></tr>
                        <tr><td><strong>Ancho:<strong></td><td>{{ $cloaca->ancho }}</td></tr>
                        <tr><td><strong>Estado:</strong></td><td><div class="btn btn-{{$cloaca->status->color}} btn-sm">{{$cloaca->status->name}}</div></td></tr>
                        <tr><td><strong>Tiempo:</strong></td><td>{{$cloaca->created_at->diffForHumans()}}</td></tr>
                    </tbody>
                   
                </table>
                
            </div>
            <td><a href="{{route('admin.cloaca.edit',$cloaca)}}" class="btn btn-secondary">Editar</a></td>
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
 <script src="{{asset('js/app.js')}}"></script>
      <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
          integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
          crossorigin="">
      </script>
    <script src="https://unpkg.com/leaflet.markercluster@1.4.1/dist/leaflet.markercluster.js"></script>

<script>
    let inputArray = [{{ $cloaca->coordenadas }}];

function splitArrayIntoChunksOfLen(arr, len) {
  var chunks = [], i = 0, n = arr.length;
  while (i < n) {
    chunks.push(arr.slice(i, i += len));
  }
  return chunks;
}

console.log(splitArrayIntoChunksOfLen(inputArray,2));
let inputRevece =inputArray.reverse();
let ubic =[splitArrayIntoChunksOfLen(inputRevece,2)];
let ubics=inputArray.slice(0,2).reverse();
console.log(ubics);

        var map = L.map('mapid').setView(ubics,17);

   L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

//     ,{
//     color: 'red',
//     weight: 7,
//     opacity: 0.5,
//     smoothFactor: 3
// }
    var polyline = L.polyline(ubic).addTo(map);
// zoom the map to the polyline
map.fitBounds(polyline.getBounds());

    //     axios.get('{{ route('api.places_cloaca.index') }}')
    //     .then(function (response) {
    //     L.geoJSON(response.data,{
    //         pointToLayer: function(geoJsonPoint,latlng) {
    //             return L.polyline(latlng);
    //         }
    //     })
    //     .bindPopup(function(layer) {
    //         //return layer.feature.properties.map_popup_content;
    //         return ('<div class="my-2"><strong>Nombre</strong> : '+layer.feature.properties.Nombre+'</div> <div class="my-2"><strong>Metros</strong> : '+layer.feature.properties.Metros+'</div><div class="my-2"><strong>Ancho</strong> : '+layer.feature.properties.Ancho+'</div><div class="my-2"><strong>Ancho</strong> : '+layer.feature.properties.Ancho+'</div><div class="my-2"><strong>Estado</strong> : '+'<div class="btn btn-'+ layer.feature.properties.color +' btn-sm">'+layer.feature.properties.Estado+'</div>'+'</div><div class="my-2"><strong>Tiempo</strong> : '+layer.feature.properties.Tiempo+'</div><div class="my-2"><strong>Fecha_Creacion</strong> : '+layer.feature.properties.Fecha_Creacion+'</div><div class="my-2"><strong>Fecha_Modificacion</strong>: '+layer.feature.properties.Fecha_Modificacion+'</div>');
    //     }).addTo(map);
    
    // })
    // .catch(function (error) {
    //     console.log(error);
    // });
    
  

</script>
@stop