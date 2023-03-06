@extends('layouts.app')
@section('content')
<div class="container">

@if(Session::has('mensaje')) 
<div class="alert alert-success alert-dismissible" role="alert">
{{Session::get('mensaje')}}   
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>
@endif
<a href="{{url('usuario/create')}}" class="btn btn-success"> Registrar nuevo chofer</a>
<br/>
<br/>
<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>id</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $usuarios as $choferes )
        <tr>
            <td>{{ $choferes->id }}</td>
            <td>
            <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$choferes->Foto}}" width="100" alt="">    
        </td>
            <td>{{$choferes->Nombre}}</td>
            <td>{{$choferes->ApellidoPaterno}}</td>
            <td>{{$choferes->ApellidoPaterno}}</td>
            <td>{{$choferes->Correo}}</td>
            <td>
            <a href="{{url('/usuario/'.$choferes->id.'/edit')}}" class="btn btn-warning">    
            Editar | 

                <form action="{{url('/usuario/'.$choferes->id)}}" class="d-inline" method="post">
                @csrf
                {{method_field('DELETE')}}
                <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borar?')" 
                value="Borrar">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $usuarios->links()!!}
</div>
@endsection