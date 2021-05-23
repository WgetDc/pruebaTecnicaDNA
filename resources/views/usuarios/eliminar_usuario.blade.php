@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">     

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Eliminar usuario</h5>
                            <div class="alert alert-danger" role="alert">
                                Importante: ¿Esta seguro de que desea eliminar a {{$usuario->nombre}} ?
                            </div> 
                  <form action="/usuario/{{$usuario->id}}" method="post" >
                    @csrf
                    @method('delete')
                   
                    <button type="submit" class="btn btn-danger btn-block">Eliminar</button>
                    <a href="/home" class="btn btn-secondary btn-block">Regresar</a>
                  </form>
                </div>
              </div>
        </div>
    </div>
</div>


@endsection
