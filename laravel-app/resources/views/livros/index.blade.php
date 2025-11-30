@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between mb-3">
  <h3>Livros</h3>
  <div>
    <a href="{{ route('livros.create') }}" class="btn btn-success">Novo Livro</a>
    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Categorias</a>
  </div>
</div>

<form class="mb-3" method="GET" action="{{ route('livros.index') }}">
  <div class="row g-2">
    <div class="col-auto">
      <select name="categoria" class="form-select" onchange="this.form.submit()">
        <option value="">Todas as categorias</option>
        @foreach($categorias as $cat)
          <option value="{{ $cat->id }}" {{ (request('categoria') == $cat->id)?'selected':'' }}>{{ $cat->nome }}</option>
        @endforeach
      </select>
    </div>
  </div>
</form>

<table class="table">
<thead><tr><th>Capa</th><th>Título</th><th>Autor</th><th>Categoria</th><th>Preço</th><th>Ações</th></tr></thead>
<tbody>
@foreach($livros as $l)
<tr>
  <td style="width:80px;">
    @if($l->capa)
      <img src="{{ asset('storage/'.$l->capa) }}" style="height:60px;">
    @endif
  </td>
  <td>{{ $l->titulo }}</td>
  <td>{{ $l->autor }}</td>
  <td>{{ $l->categoria->nome ?? '' }}</td>
  <td>{{ $l->preco }}</td>
  <td>
    <a class="btn btn-sm btn-primary" href="{{ route('livros.edit', $l) }}">Editar</a>
    <form style="display:inline" method="POST" action="{{ route('livros.destroy', $l) }}">
      @csrf @method('DELETE')
      <button onclick="return confirm('Excluir?')" class="btn btn-sm btn-danger">Excluir</button>
    </form>
  </td>
</tr>
@endforeach
</tbody>
</table>

{{ $livros->withQueryString()->links() }}
@endsection
