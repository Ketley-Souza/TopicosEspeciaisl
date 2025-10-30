<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    // Método para exibir os produtos
    public function index()
    {
        $produtos = Produto::all(); // Busca todos os produtos do banco
        return view('produtos.index', compact('produtos'));
    }

    // Método para cadastrar um novo produto
    public function store(Request $request)
    {
        Produto::create($request->all()); // Cria um novo produto
        return redirect()->back(); // Volta para a página anterior
    }
}
