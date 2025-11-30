<form method="POST" action="{{ $action }}">
  @csrf
  @if(isset($method)) @method($method) @endif
  <div class="mb-3">
    <label>Nome</label>
    <input name="nome" value="{{ old('nome', $categoria->nome ?? '') }}" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Descrição</label>
    <textarea name="descricao" class="form-control">{{ old('descricao', $categoria->descricao ?? '') }}</textarea>
  </div>
  <button class="btn btn-primary">Salvar</button>
  <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Voltar</a>
</form>
