<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    // Método para exibir todas as categorias
    public function index()
    {
        $categorias = Categoria::all(); // Busca todas as categorias do banco
        return view('categorias.index', compact('categorias'));
    }

    // Método para cadastrar uma nova categoria
    public function store(Request $request)
    {
        Categoria::create($request->all()); // Cria uma nova categoria
        return redirect()->back(); // Volta para a página anterior
    }
}
