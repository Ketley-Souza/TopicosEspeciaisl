<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class LivroController extends Controller
{
    public function __construct()
    {
        $this->middleware('simple.auth');
    }

    public function index(Request $request)
    {
        $categoriaId = $request->query('categoria');
        $query = Livro::with('categoria')->orderBy('titulo');

        if ($categoriaId) {
            $query->where('categoria_id', $categoriaId);
            // define cookie para última categoria acessada
            $cookie = cookie('ultima_categoria', $categoriaId, 60 * 24 * 30);
        } else {
            $cookie = null;
        }

        $livros = $query->paginate(10);
        $categorias = Categoria::orderBy('nome')->get();

        $response = response()->view('livros.index', compact('livros', 'categorias', 'categoriaId'));
        return $cookie ? $response->cookie($cookie) : $response;
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();
        return view('livros.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|max:255',
            'autor' => 'required|max:255',
            'ano' => 'nullable|integer',
            'preco' => 'nullable|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'capa' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('capa')) {
            $data['capa'] = $request->file('capa')->store('capas', 'public');
        }

        Livro::create($data);
        return redirect()->route('livros.index')->with('success', 'Livro criado!');
    }

    public function edit(Livro $livro)
    {
        $categorias = Categoria::orderBy('nome')->get();
        return view('livros.edit', compact('livro', 'categorias'));
    }

    public function update(Request $request, Livro $livro)
    {
        $data = $request->validate([
            'titulo' => 'required|max:255',
            'autor' => 'required|max:255',
            'ano' => 'nullable|integer',
            'preco' => 'nullable|numeric',
            'categoria_id' => 'required|exists:categorias,id',
            'capa' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('capa')) {
            if ($livro->capa)
                Storage::disk('public')->delete($livro->capa);
            $data['capa'] = $request->file('capa')->store('capas', 'public');
        }

        $livro->update($data);
        return redirect()->route('livros.index')->with('success', 'Livro atualizado!');
    }

    public function destroy(Livro $livro)
    {
        if ($livro->capa)
            Storage::disk('public')->delete($livro->capa);
        $livro->delete();
        return redirect()->route('livros.index')->with('success', 'Livro excluído!');
    }
}
