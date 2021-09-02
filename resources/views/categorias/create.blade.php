@extends('master.master3')

@section('content')
<h2>Registrar Categoría</h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="/categorias" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="nombre de la categoria" value="{{ old('nombre') }}" required>
    </div>
   
    <div class="form-group pt-2">
        <input class="btn btn-success" type="submit" value="Registrar">
        <a href="{{ url()->previous() }}" class="btn btn-success">Cancelar</a>
    </div>
   
</form>



@endsection