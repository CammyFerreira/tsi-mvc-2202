<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Produtos;

class produtosController extends Controller
{

    private $qtdPorPagina = 5;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    //Lista os dados da tabela
    public function index(Request $request)
    {
        $prod = Produtos::orderBy('id', 'ASC')->paginate($this->qtdPorPagina);
        return view('produtos.index', compact('prod'))
        ->with('i', ($request->input('page', 1) - 1) * $this->qtdPorPagina);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     //Retorna a View para criar um item da tabela
    public function create()
    {
        return view('produtos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     //Salva o novo item na tabela
    public function store(Request $request)
    {
        $this->validate($request, ['nome'=> 'required',
                                    'descricao' => 'required',
                                    'preco' => 'required']);
        $input = $request->all();

        $prod = Produtos::create($input);//recebe os dados que vier do formulário, vai pegar os dados, validar os campos(ex: formato válido para email), pega tudo e joga na variável input que vai para a model Clientes

        return redirect()->route('produtos.index')->with('sucess', 'Produto gravado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Mostra um item específico
    public function show($id)
    {
        $prod = Produtos::find($id);

        return view('produtos.show', compact('prod'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Retorna a view para edição do dado
    public function edit($id)
    {
        $prod = Produtos::find($id);

        return view ('produtos.edit', compact('prod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Salva a atualização do dado
    public function update(Request $request, $id)
    {
        $this->validate($request, ['nome'=> 'required',
                                    'descricao' => 'required',
                                    'preco' => 'required']);
$input = $request->all();

$prod = Produtos::find($id);

$prod->update($input);

return redirect()->route('produtos.index')->with('sucess', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Remove o dado
    public function destroy($id)
    {
        Produtos::find($id)->delete();

        return redirect()->route('produtos.index')->with('sucess', 'Produto removido com sucesso!');
    }
}
