@extends('layouts.app')
@section('content')
<h3>Novo Livro</h3>
@include('livros._form', ['action' => route('livros.store')])
@endsection

