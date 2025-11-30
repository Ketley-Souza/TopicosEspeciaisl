@extends('layouts.app')
@section('content')
<h3>Editar Livro</h3>
@include('livros._form', ['action' => route('livros.update', $livro), 'method' => 'PUT', 'livro' => $livro])
@endsection
