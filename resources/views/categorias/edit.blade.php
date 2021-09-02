@extends('master.master3')

@section('content')
<h2>Editar Categoría</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="/categorias/{{$categoria->id}}" method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf()
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="nombre" value="{{$categoria->nombre}}">
    </div>
    <div class="form-group">
        <input class="btn btn-success" type="submit" value="Editar">
        <a href="{{ url()->previous() }}" class="btn btn-success">Cancelar</a>
    </div>
    
</form>

@endsection