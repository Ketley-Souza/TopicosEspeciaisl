<h1>Categorias</h1>

<!-- Formulário de cadastro -->
<form action="{{ route('categorias.store') }}" method="POST">
    @csrf
    <input type="text" name="nome" placeholder="Nome da categoria" required>
    <button type="submit">Cadastrar</button>
</form>

<hr>

<!-- Lista de categorias -->
<ul>
    @foreach($categorias as $categoria)
        <li>{{ $categoria->nome }}</li>
    @endforeach
</ul>
