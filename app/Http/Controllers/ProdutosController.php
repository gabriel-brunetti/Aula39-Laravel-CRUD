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

    public function update($id){
        
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

    public function destroy($id){
        // Carregando o produto da base de dados
        // $produto = Produto::find($id);

        // Remover elemento do Bando de Dado
        // $produto->delete();

        // Deletando o produto
        Produto::where('id',$id)->delete();

        // Redirecionar para a lista de produtos
        return redirect('/produtos');
    }
}