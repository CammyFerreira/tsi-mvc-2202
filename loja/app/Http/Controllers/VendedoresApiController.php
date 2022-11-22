<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedores;

class VendedoresApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Vendedores::all(); //mostrar todos os vendedores
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $json = $request->getContent();

        return Vendedores::create(json_decode($json, JSON_OBJECT_AS_ARRAY));
        //metodo create espera receber um vetor e não um objeto então o json_decode transforma um objeto em um array
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendedor = Vendedores::find($id);

        if($vendedor){
            return $vendedor;//se o vendedor existe retorna o vendedor 
        }else{
            return json_encode([$id => 'não existe']);//se não ele transforma em objeto 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vendedor = Vendedores::find($id);

        if($vendedor){
           $json = $request->getContent();
           $atualizacao = json_decode($json, JSON_OBJECT_AS_ARRAY);//json_decode transforma um objeto json para array
           $vendedor->nome = $atualizacao['nome'];
           $vendedor->matricula = $atualizacao['matricula'];
           $ret = $vendedor->update() ? [$id => 'atualizado'] : [$id => 'erro ao atualizar'];
        }else{
            $ret = [$id => 'não existe'];
        }
        return json_encode($ret);//transforma em um objeto json
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendedor = Vendedores::find($id);

        if($vendedor){
            $ret = $vendedor->delete() ? [$id => 'apagado'] : [$id => 'erro ao apagar'];
        }else{
            $ret = [$id => 'Não existe'];
        }
        return json_encode($ret);//transforma em um objeto json
    }
}
