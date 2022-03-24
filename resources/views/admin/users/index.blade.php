@extends('adminlte::page')

@section('title', 'Usuarios')
@section('css')
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@endsection

@section('content_header')
@can('admin.users.create')
<a class="btn btn-secondary float-right " href="{{route('admin.users.create')}}">Agregar Usuario</a>
@endcan

    <h1>Lista de Usuarios</h1>
@stop

@section('content')
@if (session('creacion'))
    <div class="alert alert-success"> 
        <strong>{{session('creacion')}}</strong>
    </div>
@endif
@if (session('Delete'))
    <div class="alert alert-success">
        <strong>{{session('Delete')}}</strong>
    </div> 
@endif
    <div class="card">
            
        <div class="card-body">
            <table class="table table-striped" id="myTable" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Horas</th>
                        <th>Fecha De Creación</th>
                        <th>Fecha De Actualizacion</th>
                        <th></th>
                        <th></th>
                     </tr>
                 </thead>
                 <tbody>
                    @foreach ($users as $user)
                    <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                    <td>{{$user->created_at}}</td>
                    <td>{{$user->updated_at }}</td>
                            
                    <td >@can('admin.users.edit')
                        <a href="{{route('admin.users.edit',$user)}}" class=" btn btn-primary btn-sm">Asignar Rol</a>
                    @endcan
                        </td>
                    <td>@can('admin.users.destroy')
                        <form action="{{route('admin.users.destroy',$user)}}" method="post" class="formulario-eliminar">
                            @csrf
                            @method('delete')
                            <button type="submit" class=" btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    @endcan
                         
                    </td>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
@stop


@section('js')
<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

@if (session('mensaje')=='ok')
    <script>
        Swal.fire(
            'Eliminado!',
            'El Usuario ha sido eliminado.',
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
        autowidth: false,
        responsive: true,
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