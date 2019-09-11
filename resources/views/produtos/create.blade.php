@extends('layouts.admin-master')

@section('content')
<form action="/produtos/" class="flex-grow-1 w-auto m-5" method="post">
	{{-- METODO POST PARA ENVIAR DADOS AO SERVIDOR --}}
	@method('post')
	@csrf
	{{-- CAMPO NOME --}}
	<div class="form-group">
		<label for="nome">Nome</label>
		<input type="text" name="nome" class="form-control @error('nome') is-invalid @enderror" id="nome" placeholder="Nome do produto">
		@error('nome')
			<div class="invalid-feedback">
				{{$message}}
			</div>
		@enderror
	</div>
	{{-- CAMPO CATEGORIAS --}}
	<div class="form-group">
		<label for="categoria">Categoria</label>
		<select class="form-control @error('categoria') is-invalid @enderror" id="categoria" name="categoria">
			@foreach($categorias as $c)
				{{-- <option value="selected">{{ $produto->categoria->nome}} </option> --}}
				{{-- <option value="">{{ $c->nome }} </option> --}}

				<option value ="{{ $c->id}}">
					{{ $c->nome }}
				</option>
			@endforeach
		@error('categoria')
			<div class="invalid-feedback">
				{{$message}}
			</div>
		@enderror
		</select>
	</div>
	{{-- CAMPO PREÇO --}}
	<div class="form-group">
		<label for="nome">Preço</label>
		<input type="number" step="0.01" class="form-control @error('preco') is-invalid @enderror" name="preco" id="preco" placeholder="Preço">
		@error('preco')
			<div class="invalid-feedback">
				{{$message}}
			</div>
		@enderror
	</div>
	{{-- CAMPO QUANTIDADE --}}
	<div class="form-group">
		<label for="qtde">Quantidade</label>
		<input type="number" class="form-control @error('quantidade') is-invalid @enderror" id="quantidade" name="quantidade" placeholder="Quantidade">
		@error('quantidade')
			<div class="invalid-feedback">
				{{$message}}
			</div>
		@enderror
	</div>
	{{-- BOTAO SALVAR --}}
	<button class="btn btn-warning float-right w-25">Salvar</button>
</form>
@endsection