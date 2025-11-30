@extends('layouts.app')
@section('content')
<h3>Editar Categoria</h3>
@include('categorias._form', ['action' => route('categorias.update', $categoria), 'method' => 'PUT', 'categoria' => $categoria])
@endsection
