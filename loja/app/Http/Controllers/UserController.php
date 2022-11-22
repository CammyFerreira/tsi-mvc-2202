<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Lista os dados da tabela
    public function index(Request $request)
    {
        $data = User::orderBy('id','DESC')->paginate(5);//criando uma paginação e retornando a view
        return view('users.index',compact('data'))->with('i',($request->input('page',1)-1)*5);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Retorna a View para criar um item da tabela
    public function create()
    {
        $roles=Role::pluck('name','name')->all();//extraí a regra de nome da model e aplica para todos
        return view('users.create',compact('roles')); 00
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     //armazenar os dados do formulário no banco
    public function store(Request $request)
    {
        //valida os campos nome, email e senha
        $this->validate($request,['name'=>'required','email'=>'required|email|unique:users,email','password'=>'required|same:confirm-password','roles'=>'required']);
        $input=$request->all();$input['password']=Hash::make($input['password']);//verificação senha
        $user=User::create($input);
        $user->assignRole($request->input('roles'));//assinar uma regra
        return redirect()->route('users.index')->with('success','Usuário criado com sucesso');//redireciona para a a view de usuarios
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
        $user=User::find($id);//buscando o usuário pelo id e retornando na view
        return view('users.show',compact('user'));    //compact - Cria um array contendo variáveis e seus valores.
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
        $user=User::find($id);//buscando o usuário pelo id
        $roles = Role::pluck('name','name')->all();//usando a regra de nomes da model 
        $userRole = $user->roles->pluck('name','name')->all();//usando a regra de nomes da model 
        return view('users.edit',compact('user','roles','userRole'));//retorna a view de edição
    //compact - Cria um array contendo variáveis e seus valores.
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
        //valida o nome, email e senha
        $this->validate($request, ['name' => 'required', 'email' => 'required|email|unique: users,email,' .  $id, 'password' => 'same:confirm-password',  'roles' => 'required']); $input = $request ->all();
        if(!empty($input['password'])){//se o campo senha não for vazio
        $input['password'] = Hash::make($input['password']);//compara a senha armazenada
        }else{
        $input = Arr::except($input,array('password'));//remove os pares chave e valor do array
        }
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();//consulta no banco de dados e chama o método delete();
        $user->assignRole($request->input('roles'));
        return redirect()->route('users.index')->with('success','Usuário atualizado com sucesso');//redireciona para a view
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
        User::find($id)->delete();//busca o usuário pelo id e deleta
        return redirect()->route('users.index')->with('success','Usuário removido com sucesso');//redireciona para a view
    }
}