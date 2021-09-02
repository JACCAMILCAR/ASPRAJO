@extends('master.master3')

@section('content')
    @if(Session::has('Mensaje'))
    <div class="alert alert-success" role="alert">
        {{   Session::get('Mensaje')   }}
    </div>
    @endif
            <div class="row py-lg-2">
                <div class="col-md-6">
                    <h2>Añadir Especie</h2>
                </div>
                    <div class="col-md-6">
                        <a href="/especies/create" class="btn btn-success btn-lg float-md-right" role="button" aria-pressed="true">Añadir Nueva Especie</a>
                    </div>

            </div>
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
                    Lista de Especie
            </div>
          
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>                                            
                            </tfoot>
                            <tbody>
                                @foreach($especies as $especie)                                
                                <tr > 
                                    <td>{{$especie['nombre']}}</td>
                                    <td>
                                    
                                        <a href="/especies/{{$especie['id']}}/edit"><i class="fa fa-edit"></i></a>
                                        
                                        <form action="{{ url('especies/'.$especie->id) }}" method="post" style="display: inline;">
                                            {{csrf_field()}}
                                            {{ method_field('DELETE')}}
                                            <button type="submit" onclick="return confirm('¿Eliminar?')" class="btn-success"><i class="fa fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach                                        
                            </tbody>
                        </table>

@section('js_user')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('frontend') }}/dist/assets/demo/chart-area-demo.js"></script>
<script src="{{ asset('frontend') }}/dist/assets/demo/chart-bar-demo.js"></script>
<script src="{{ asset('frontend') }}/dist/assets/demo/datatables-demo.js"></script>

@endsection

@endsection