@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Vendedores</h2>
        </div>
        <div class="pull-right">

        @can('vendedores-create')
            <a class="btn btn-success" href="{{ route('vendedores.create') }}"> + Novo vendedor</a>
        @endcan

        </div>
    </div>
</div>

<br>

@if ($message = Session::get('success'))

<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>

@endif

<table class="table table-bordered">

 <tr>
   <th>ID</th>
   <th>Nome</th>
   <th>Matricula</th>
   <th width="280px">Ação</th>
 </tr>

 @foreach ($vendedor as $key => $vend)

  <tr>
    <td>{{ $vend->id }}</td>
    <td>{{ $vend->nome }}</td>
    <td>{{ $vend->matricula }}</td>
    <td>
       <a class="btn btn-info" href="{{ route('vendedores.show',$vend->id) }}">Mostrar</a>
       @can('user-edit')
       <a class="btn btn-primary" href="{{ route('vendedores.edit',$vend->id) }}">Editar</a>
        @endcan

        @can('vendedores-delete')
       {!! Form::open(['method' => 'DELETE','route' => ['vendedores.destroy', $vend->id],'style'=>'display:inline']) !!}



        {!! Form::submit('Apagar', ['class' => 'btn btn-danger']) !!}



        {!! Form::close() !!}

        @endcan
    </td>
  </tr>

 @endforeach

</table>

{!! $vendedor->render() !!}

@endsection

<!-- https://bitbucket.org/senac-tsi-php/senac-mvc-2201/src/0407a25590ac6747ea1c19a61c72b8386569b0c0/primeiro_site/resources/views/vendedores/index.blade.php?at=aula%2F03-06-22 -->
