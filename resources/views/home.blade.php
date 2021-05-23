@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">          
            <div class="col-md-8">
                <form action="">
                    <div class="row">
                        <div class="col-8">                        
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">🔎</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Buscar usuario" aria-label="Nombre de usuario" aria-describedby="basic-addon1" name="txtBuscar">
                            </div>        
                        </div>
                        <div class="col-4">
                            <div>
                                <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                            </div>
                        </div>
                    </div>
                </form>
                @foreach($usuarios as $usuario)
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">{{$usuario->nombre}} {{$usuario->apellido}}</h5>
                        <span class="card-subtitle mb-2 text-muted">{{$usuario->email}}</span>
                        <span class="card-subtitle mb-2 text-muted"">{{$usuario->rut}}</span>
                    <p>{{$usuario->direccion}}</p>
                    @if($usuario->estado == 'activo')
                        <span class="badge badge-success">Activo</span>
                    @endif                  
                    @if($usuario->estado == 'desactivado')
                    <span class="badge badge-danger">Desactivado</span>
                    @endif                    
                    <hr>
                    <a href="/usuario/{{$usuario->id}}/edit" class="card-link">Editar usuario</a>
                    <a href="/usuario/{{$usuario->id}}/confirmDelete" class="card-link">Eliminar usuario</a>
                    </div>
                </div>
                <hr>
                @endforeach
                {{$usuarios->links()}}
            </div>
        

        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">Registrar usuario</h5>
                  <form action="/usuario" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="txtNombre">Nombre</label>
                      <input type="text" class="form-control" name="txtNombre">
                    </div>
                    <div class="form-group">
                        <label for="txtApellido">Apellido</label>
                        <input type="text" class="form-control" name="txtApellido">
                    </div>
                    <div class="form-group">
                        <label for="txtEmail">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="txtEmail" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                               
                    </div>
                    <div class="form-group">
                        <label for="txtDireccion">Direccion</label>
                        <textarea type="text" class="form-control" name="txtDireccion"> </textarea>
                    </div>
                    <div class="form-group">
                        <label for="txtRut">Rut</label>
                        <input type="text" class="form-control" id="rut" name="rut" required oninput="checkRut(this)">
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputGroupEstado">Estado</label>
                        <select class="custom-select" name="inputGroupEstado">
                          <option value="activo">Activo</option>
                          <option value="desactivado">Desactivado</option>
                        </select>
                      </div>
                    <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                  </form>
                </div>
              </div>
        </div>
    </div>
</div>




<script>

    //PD para DNAGroup: Este codigo fuente lo obtuve de https://gist.github.com/rotvulpix/69a24cc199a4253d058c
    function checkRut(rut) {
    // Despejar Puntos
    var valor = rut.value.replace('.','');
    // Despejar Guión
    valor = valor.replace('-','');
    
    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0,-1);
    dv = valor.slice(-1).toUpperCase();
    
    // Formatear RUN
    rut.value = cuerpo + '-'+ dv
    
    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if(cuerpo.length < 7) { rut.setCustomValidity("RUT Incompleto"); return false;}
    
    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;
    
    // Para cada dígito del Cuerpo
    for(i=1;i<=cuerpo.length;i++) {
    
        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);
        
        // Sumar al Contador General
        suma = suma + index;
        
        // Consolidar Múltiplo dentro del rango [2,7]
        if(multiplo < 7) { multiplo = multiplo + 1; } else { multiplo = 2; }
  
    }
    
    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);
    
    // Casos Especiales (0 y K)
    dv = (dv == 'K')?10:dv;
    dv = (dv == 0)?11:dv;
    
    // Validar que el Cuerpo coincide con su Dígito Verificador
    if(dvEsperado != dv) { rut.setCustomValidity("RUT Inválido"); return false; }
    
    // Si todo sale bien, eliminar errores (decretar que es válido)
    rut.setCustomValidity('');
}
</script>
@endsection
