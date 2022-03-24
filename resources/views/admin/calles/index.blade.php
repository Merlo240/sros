@extends('adminlte::page')

@section('title', 'Calles')
@section('css')

<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
@endsection
@section('content_header')
@can('admin.calles.create')
<a class="btn btn-secondary float-right " href="{{route('admin.calles.create')}}">Agregar Calle</a>
@endcan

    <h1>Listado de Calles</h1>
@stop


@section('content')
    <div class="card">
            
        <div class="card-body">
            <table class="table table-striped" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Barrio</th>
                        <th>Calle</th>
                        <th ></th>
                        <th ></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($calles as $calle)
                    <tr>
                        {{-- <td scope="row"></td> --}}
                        <td>{{$calle->id}}</td>
                    <td>{{$calle->barrios->name}}</td>
                    <td>{{$calle->name}}</td>
                    <td >@can('admin.calles.edit')
                        <a href="{{route('admin.calles.edit',$calle)}}" class=" btn btn-primary btn-sm">Editar</a>
                    @endcan
                        </td>
                    <td>@can('admin.calles.destroy')
                        <form action="{{route('admin.calles.destroy',$calle)}}" method="post" class="formulario-eliminar">
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
         $(document).ready( function () {
    $('#myTable').DataTable()



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
