<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
  @csrf
  @if(isset($method)) @method($method) @endif

  <div class="mb-3">
    <label>Título</label>
    <input name="titulo" value="{{ old('titulo', $livro->titulo ?? '') }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Autor</label>
    <input name="autor" value="{{ old('autor', $livro->autor ?? '') }}" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Ano</label>
    <input type="number" name="ano" value="{{ old('ano', $livro->ano ?? '') }}" class="form-control">
  </div>

  <div class="mb-3">
    <label>Preço</label>
    <input type="number" step="0.01" name="preco" value="{{ old('preco', $livro->preco ?? '') }}" class="form-control">
  </div>

  <div class="mb-3">
    <label>Categoria</label>
    <select name="categoria_id" class="form-select" required>
      @foreach($categorias as $c)
        <option value="{{ $c->id }}" {{ (old('categoria_id', $livro->categoria_id ?? '') == $c->id) ? 'selected' : '' }}>{{ $c->nome }}</option>
      @endforeach
    </select>
  </div>

  <div class="mb-3">
    <label>Capa (PNG/JPG)</label>
    <input type="file" name="capa" accept=".png,.jpg,.jpeg" class="form-control">
    @if(!empty($livro->capa))
      <div class="mt-2"><img src="{{ asset('storage/'.$livro->capa) }}" style="height:90px;"></div>
    @endif
  </div>

  <button class="btn btn-primary">Salvar</button>
  <a href="{{ route('livros.index') }}" class="btn btn-secondary">Voltar</a>
</form>
