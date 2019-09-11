@extends('layouts.admin-master',['CreateProdutoAtivo'=>true])

@section('content')
<form action="/produtos/{{ $produto->id }}" class="flex-grow-1 w-auto m-5" method="post">
	@method('put')
	@csrf
	{{-- CAMPO NOME --}}
	<div class="form-group">
		<label for="nome">Nome</label>
		<input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" id="nome" placeholder="Nome do produto" value="{{$produto->nome}}">
		@error('nome')
		<div class="invalid-feedback">
			{{$message}}		
		</div>
		@enderror
	</div>
	{{-- CAMPO CATEGORIA --}}
	<div class="form-group">
		<label for="categoria">Categoria</label>
		<select class="form-control" id="categoria" name="categoria">
			@foreach($categorias as $c)
			{{-- <option value="selected">{{ $produto->categoria->nome}} </option> --}}
			{{-- <option value="">{{ $c->nome }} </option> --}}

			{{-- resolvendo com if ternário / solução Sérgio --}}
			<option {{ $c->id == $produto->categoria->id ? 'selected' : ''}} value ="{{ $c->id}}">
				{{ $c->nome }}
			</option>
			@endforeach	
		</select>
	</div>
	{{-- CAMPO PREÇO --}}
	<div class="form-group">
		<label for="preco">Preço</label>
		<input type="number" step="0.01" class="form-control" name="preco" id="preco" placeholder="Preço" value="{{$produto->preco}}">
	</div>
	{{-- CAMPO QUANTIDADE --}}
	<div class="form-group">
		<label for="qtde">Quantidade</label>
		<input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade" value="{{$produto->quantidade}}">
	</div>
	{{-- BOTÃO SALVAR --}}
	<button class="btn btn-warning float-right w-25">Salvar</button>
</form>
@endsection