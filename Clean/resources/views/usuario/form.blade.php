<h1>{{$modo}} empleado</h1>

@if(count($errors)>0)
<div class="alert alert-danger" role="alert">
  <ul>
 @foreach($errors->all() as $error)
   <li> {{$error}}</li>
 @endforeach
 </ul>
</div>
@endif
<div class="form-group">
<label for="Nombre"> Nombre </label>
  <input type="text" class="form-control" name="Nombre" value="{{isset($usuario->Nombre)?$usuario->Nombre:''}}" id="Nombre" >
  <br>
  </div>

  <div class="form-group">
  <label for="ApellidoPaterno"> Apellido Paterno</label>
  <input type="text" class="form-control" name="ApellidoPaterno" value="{{isset($usuario->ApellidoPaterno)?$usuario->ApellidoPaterno:''}}" id="ApellidoPaterno">
  <br>
</div>

<div class="form-group">
  <label for="ApellidoMaterno"> Apellido Materno</label>
  <input type="text" class="form-control" name="ApellidoMaterno" value="{{isset($usuario->ApellidoMaterno)?$usuario->ApellidoMaterno:''}}" id="ApellidoMaterno">
  <br>
</div>

<div class="form-group">
  <label for="Correo"> Correo </label>
  <input type="text" class="form-control" name="Correo" value="{{isset($usuario->Correo)?$usuario->Correo:''}}" id="Correo">
  <br>
</div>

  <div class="form-group">
  <label for="Foto"> </label>
  @if(isset($usuario->Foto))
  <img src="{{asset('storage').'/'.$usuario->Foto}}" width="100" alt="">    
   @endif      
  <input type="file" class="form-control" name="Foto" value="" id="Foto">
  <br>
</div>

  
  <input class="btn btn-success" type="submit" value="{{$modo}} datos" >
  <a class="btn btn-primary" href="{{url('usuario/')}}"> Regresar</a>
  <br>