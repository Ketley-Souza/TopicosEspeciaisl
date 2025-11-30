@extends('layouts.app')
@section('content')
<h3>Nova Categoria</h3>
@include('categorias._form', ['action' => route('categorias.store')])
@endsection
