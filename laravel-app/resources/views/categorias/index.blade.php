@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Categorias</h3>
    <a href="{{ route('categorias.create') }}" class="btn btn-success">Nova Categoria</a>
</div>

@if($ultima)
    <div class="mb-2"><small>Última categoria visitada (cookie): {{ $ultima }}</small></div>
@endif

<table class="table table-striped">
<thead><tr><th>Nome</th><th>Descrição</th><th>Ações</th></tr></thead>
<tbody>
@foreach($categorias as $c)
<tr>
  <td>{{ $c->nome }}</td>
  <td>{{ $c->descricao }}</td>
  <td>
    <a class="btn btn-sm btn-primary" href="{{ route('categorias.edit', $c) }}">Editar</a>
    <form style="display:inline" method="POST" action="{{ route('categorias.destroy', $c) }}">
        @csrf @method('DELETE')
        <button onclick="return confirm('Excluir?')" class="btn btn-sm btn-danger">Excluir</button>
    </form>
  </td>
</tr>
@endforeach
</tbody>
</table>
@endsection
