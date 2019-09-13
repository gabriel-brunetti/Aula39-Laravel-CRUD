<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Categoria;

class ProdutosController extends Controller
{
    public function index(){

        // Carregar os produtos da base de dados
        // $produtos = Produto::all();
        // Carregar os produtos paginados
        $produtos = Produto::paginate(5);

        // Retortar a view com os produtos levantados
        return view(
            'produtos.index',compact('produtos')
            // funcao compact passa a variavel $produtos para a view
        );
    }

    // MOSTRAR AS INFORMAÇÔES ESPECIFICAS DE UM PRODUTO
    public function show($id){
        // Carrega o produto da base de dados
        // comando FIND(encontrar) igual o SQL
        $produto = Produto::find($id);

        // Retornar a view do produto selecionado
        return view(
            'produtos.show',
            compact('produto')
        );
    }

    // CARREGAR FORMULÁRIO EDIÇÃO PRODUTOS
    public function edit($id){
        // Carrega o produto da base de dados
        // comando FIND(encontrar) igual o SQL
        $produto = Produto::find($id);

        // Carregar categorias do Bando de Dados
        $categorias = Categoria::all();

        // Retornar a view do produto a ser editado
        return view(
            'produtos.edit',
            compact('produto','categorias')
        );
    }

    // ALTERAR UM PRODUTO - MANDAR DADOS PARA A DB
    public function update($id){

        // Validar o request
        // request -> pega o valor do campo do formulario
        request()->validate(
            [
                // $campo => $regra
                'nome' => 'required',
                'categoria' => 'required',
                // gte = greater than or equal
                // gt = greather than
                // lt = less than
                'preco' => 'required|gte:0|lt:999.99',
                'quantidade' => 'required|gt:0|lt:1000',
            ]
            );
        
        // Carregando o produto da base de dados
        $produto = Produto::find($id);

        // Alterar os valores do produto
        $produto->nome = request('nome');
        $produto->preco = request('preco');
        $produto->quantidade = request('quantidade');
        // unico que fica diferente
        $produto->id_categoria = request('categoria');

        // Salvar as alterações no banco de dados
        $produto->save();

        // Redirecionar para a lista de produtos
        return redirect('/produtos');
    }   

    // DELETAR UM PRODUTO
    public function destroy($id){
        // Carregando o produto da base de dados
        // $produto = Produto::find($id);

        // Remover elemento do Bando de Dado
        // $produto->delete();

        // Deletando o produto
        Produto::where('id',$id)->delete();

        // Redirecionar para a lista de produtos
        return back();
    }

    // MOSTRAR FORMULÁRIO CRIAÇÃO DE PRODUTO
    public function create(){
        // importando categorias
        $categorias = Categoria::all();

        // Retornando a view
        return view(
            'produtos.create',compact('categorias')
        );
    }

    // CRIAR UM PRODUTO - MANDAR PARA O DB
    public function store(){
        // Validar request
        // request -> pega o valor do campo do formulario
        request()->validate(
            [
                // $campo => $regraDeValidacao
                'nome' => 'required',
                'categoria' => 'required',
                'preco' => 'required|gte:0|lt:999.99',
                'quantidade' => 'required|gt:0|lt:1000',
            ]
        );

        // Novo Produtos
        $p = new Produto;

        // Atribuindo valores ao Produto
        $p->nome = request('nome');
        $p->preco = request('preco');
        $p->quantidade = request('quantidade');
        // unico que fica diferente
        $p->id_categoria = request('categoria');

        // Salvar o produto
        $p->save();

        return redirect(
            '/produtos'
        );

    }
}