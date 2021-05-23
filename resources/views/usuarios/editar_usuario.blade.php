@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">     

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Editar usuario</h5>
                            @if($usuario->estado == 'activo')
                            <div class="alert alert-success" role="alert">
                                Importante: {{$usuario->nombre}} actualmente es un usuario {{$usuario->estado}}
                            </div>
                            @endif
                            @if($usuario->estado == 'desactivado')
                            <div class="alert alert-danger" role="alert">
                                Importante: {{$usuario->nombre}} actualmente es un usuario {{$usuario->estado}}
                            </div>                               
                            @endif
                  <form action="/usuario/{{$usuario->id}}" method="post" >
                    @csrf
                    @method('put')
                    <div class="form-group">
                      <label for="txtNombre">Nombre</label>
                      <input type="text" class="form-control" name="txtNombre" value="{{$usuario->nombre}}">
                    </div>
                    <div class="form-group">
                        <label for="txtApellido">Apellido</label>
                        <input type="text" class="form-control" name="txtApellido" value="{{$usuario->apellido}}">
                    </div>
                    <div class="form-group">
                        <label for="txtEmail">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="txtEmail" value="{{$usuario->email}}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                               
                    </div>
                    <div class="form-group">
                        <label for="txtDireccion">Direccion</label>
                        <textarea type="text" class="form-control" name="txtDireccion"> {{$usuario->direccion}} </textarea>
                    </div>
                    <div class="form-group">
                        <label for="txtRut">Rut</label>
                        <input type="text" class="form-control" id="rut" name="rut" required oninput="checkRut(this)" value="{{$usuario->rut}}">
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputGroupEstado">Estado</label>
                        <select class="custom-select" name="inputGroupEstado">
                            @if($usuario->estado == 'activo')
                                <option value="activo">Activo</option>
                                <option value="desactivado">Desactivado</option>
                            @endif
                            @if($usuario->estado == 'desactivado')
                                <option value="desactivado">Desactivado</option>
                                <option value="activo">Activo</option>                                
                            @endif
                          
                        </select>
                      </div>
                    <button type="submit" class="btn btn-success btn-block">Actualizar datos del usuario</button>
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
