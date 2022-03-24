@extends('adminlte::page')

@section('title', 'Cordon Cuneta')

@section('css')
<link rel="icon" type="image/png" href="{{ asset('logo-municipalidad.png') }}">
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@stop
@section('content_header')
@can('admin.bacheos.create')
<a class="btn btn-secondary float-right" href="{{route('admin.cordon.create')}}">Agregar Obra</a>  
@endcan
  
<h1>Lista De Cordones</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-striped display compact" id="myTable" style="width:100%">
            <thead class="thead-inverse">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>metros</th>
                    <th>ancho</th>
                    <th>Estado</th>
                    <th>Tiempo</th>
                    <th>Fecha de Creacion</th>
                    <th>Fecha de Actualizacion</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($cordon as $cordones)
                        
                    
                    <tr>
                        <td>{{$cordones->id}}</td>
                        <td>{{$cordones->nombre}}</td>
                        <td>{{$cordones->metros}}</td>
                        <td>{{$cordones->ancho}}</td>
                        <td ><div class="btn btn-{{$cordones->status->color}} btn-sm">{{$cordones->status->name}}</div></td>
                        <td>{{$cordones->created_at->diffForHumans()}}</td>
                        <td>{{$cordones->created_at}}</td>
                        <td>{{$cordones->updated_at}}</td>
                        <td >
                            <a href="{{route('admin.cordon.edit',$cordones)}}" class=" btn btn-primary btn-sm">Editar</a>
                     
                            </td>
                        <td>
                            <form action="{{route('admin.cordon.destroy',$cordones)}}" method="post" name="formulario">
                                @csrf
                                @method('delete')
                                <button type="submit" class=" btn btn-danger btn-sm show_confirm" >Eliminar</button>
                            </form> 
                             
                        </td>
                        <td >
                            <a href="{{route('admin.cordon.show',$cordones)}}" class=" btn btn-primary btn-sm">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
               
        </table>
    </div>
</div>

@stop


@section('js')
<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>

@if (session('mensaje')=='ok')
    <script>
        
        Swal.fire(
            'Eliminado!',
            'El Cordon Cuneta ha sido eliminada.',
            'success'
            ) 
    </script>
   
@endif

 <script>
var idioma={
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "NingÃºn dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Ãšltimo",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    },
    "buttons": {
        "copyTitle": 'Informacion copiada',
        "copyKeys": 'Use your keyboard or menu to select the copy command',
        "copySuccess": {
            "_": '%d filas copiadas al portapapeles',
            "1": '1 fila copiada al portapapeles'
        },

        "pageLength": {
        "_": "Mostrar %d filas",
        "-1": "Mostrar Todo"
        }
    }
};

     $(document).ready( function () {
    $('#myTable').DataTable({
        // ajax:"{{route('datatables.user')}}",
        // processing: true,
        // serverSide: true,
        // columns:[
        //     {data:'id'},{data:'Barrio'},{data:'calle_id'},{data:'numeracion'},{data:'largo'},{data:'ancho'},{data:'mts'},{data:'status_id'},{data:'Tiempo'},{data:'created_at'},{data:'updated_at'}
        // ],
        autowidth: false,
        dom: 'Bfrtip',
        responsive: true,
        "aoColumnDefs": [
            { "sWidth": "10%", "aTargets": [ -1 ] }
        ],
         pageLength: 50,
    deferRender: true,  
        language: idioma,
        buttons: {
dom: {
container:{
  tag:'div',
  className:'flexcontent'
},
buttonLiner: {
}
},

buttons: [


        {
            extend:    'copyHtml5',
            text:      'Copiar',
            title:'Lista de Bacheo',
            titleAttr: 'Copiar',
            className: 'btn btn-app export barras',
            exportOptions: {
                columns: [ 0, 1 , 2 ,3,4,5,6,7,8,9,10 ]
            }
        },
        
        {
            extend:    'excelHtml5',
            text:      'Excel',
            title:'Lista de Bacheo',
            titleAttr: 'Excel',
            className: 'btn btn-app export excel',
            exportOptions: {
                columns: [ 0, 1 , 2 ,3,4,5,6,7,8,9,10]
            },
        },
        {
            extend:    'csvHtml5',
            text:      'CSV',
            title:'Lista de Bacheo',
            titleAttr: 'CSV',
            className: 'btn btn-app export csv',
            exportOptions: {
                columns: [ 0, 1 , 2 ,3,4,5,6,7,8,9,10 ]
            }
        },
        {
            extend:    'print',
            text:      'Print',
            title:'Lista de Bacheo',
            titleAttr: 'Imprimir',
            className: 'btn btn-app export imprimir',
            exportOptions: {
                columns: [ 0, 1 , 2 ,3,4,5,6,7,8,9,10 ]
            }
        },
        {
            extend:    'pageLength',
            titleAttr: 'Registros a mostrar',
            className: 'selectTable'
        }
    ]


}

    } );


    
} );
     
 </script>

  <script>

$('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          Swal.fire({
            title: 'Estas seguro?',
  text: "¡No podrás revertir esto!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: '¡Sí, bórralo!',
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
        

</script>
@stop