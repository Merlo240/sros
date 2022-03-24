@extends('adminlte::page')

@section('title', 'Roles')
@section('css')
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
@stop

@section('content_header')
@can('admin.roles.create')
<a class="btn btn-secondary float-right " href="{{route('admin.roles.create')}}">Nuevo Rol</a>
@endcan

    <h1>Lista de Roles</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                    <tr>
                        <td>{{$rol->id}}</td>
                        <td>{{$rol->name}}</td>
                        <td width="10px">
                            @can('admin.roles.edit')
                            <a href="{{route('admin.roles.edit',$rol)}}" class=" btn btn-primary btn-sm">Editar</a>
                            @endcan
                        </td>
                        <td width="10px">@can('admin.roles.destroy')
                            <form action="{{route('admin.roles.destroy',$rol)}}" method="post" class="formulario-eliminar">
                                @csrf
                                @method('delete')
                                <button type="submit" class=" btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        @endcan
                            
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

@if (session('mensaje')=='ok')
    <script>
        Swal.fire(
            'Eliminado!',
            'El Barrio ha sido eliminado.',
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
        language: idioma,
    })


$('.formulario-eliminar').submit(function(e){
      e.preventDefault();
      Swal.fire({
title: 'Estas seguro?',
text: "¡No podrás revertir esto!",
icon: 'warning',
showCancelButton: true,
confirmButtonColor: '#3085d6',
cancelButtonColor: '#d33',
confirmButtonText: '¡Sí, bórralo!',
}).then((result) => {
if (result.isConfirmed) {
this.submit();
}
})
});

});

</script>
@stop