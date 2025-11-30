<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function __construct()
    {
        // Usuário precisa estar logado para todas as ações (ajuste se quiser permitir index/show público)
        $this->middleware('simple.auth');
    }

    public function index(Request $request)
    {
        $categorias = Categoria::orderBy('nome')->get();
        $ultima = $request->cookie('ultima_categoria'); // cookie
        return view('categorias.index', compact('categorias', 'ultima'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'nullable',
        ]);

        $categoria = Categoria::create($data);

        // definir cookie de última categoria acessada (30 dias)
        return redirect()->route('categorias.index')
            ->with('success', 'Categoria criada!')
            ->cookie('ultima_categoria', $categoria->id, 60 * 24 * 30);
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nome' => 'required|max:255',
            'descricao' => 'nullable',
        ]);

        $categoria->update($data);
        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada!');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoria excluída!');
    }
}
