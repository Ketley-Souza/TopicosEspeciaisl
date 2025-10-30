<h1>Produtos</h1>

<!-- Formulário de cadastro -->
<form action="{{ route('produtos.store') }}" method="POST">
    @csrf
    <input type="text" name="nome" placeholder="Nome do produto" required>
    <input type="number" step="0.01" name="preco" placeholder="Preço">
    <button type="submit">Cadastrar</button>
</form>

<hr>

<!-- Lista de produtos -->
<ul>
    @foreach($produtos as $produto)
        <li>{{ $produto->nome }} - R$ {{ $produto->preco }}</li>
    @endforeach
</ul>
