<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Clientes;

class ClienteController extends Controller
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
        $cli = Clientes::orderBy('id', 'ASC')->paginate($this->qtdPorPagina);
        return view('clientes.index', compact('cli'))
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
       return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    ////Salva o novo item na tabela
    public function store(Request $request)
    {
        //armazenar os dados do formulário no banco
        $this->validate($request, ['nome'=> 'required',
                                   'email' => 'required|email']);
        $input = $request->all();

        $cliente = Clientes::create($input);//recebe os dados que vier do formulário, vai pegar os dados, validar os campos(ex: formato válido para email), pega tudo e joga na variável input que vai para a model Clientes

        return redirect()->route('clientes.index')->with('sucess', 'Cliente gravado com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    ////Mostra um item específico
    public function show($id)
    {
        //quando clicar em um regitsro específico
        $cliente = Clientes::find($id);

        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Retorna a View para edição do dado
    public function edit($id)
    {
        $cliente = Clientes::find($id);

        return view ('clientes.edit', compact('cliente'));

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
                                   'email' => 'required|email']);
        $input = $request->all();

        $cliente = Clientes::find($id);

        $cliente->update($input);

        return redirect()->route('clientes.index')->with('sucess', 'Cliente atualizado com sucesso!');

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
        Clientes::find($id)->delete();

        return redirect()->route('clientes.index')->with('sucess', 'Cliente removido com sucesso!');

    }
}
