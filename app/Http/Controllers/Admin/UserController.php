<?php

namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class UserController extends Controller
{

  // -- sem compact -- //
  // public function index (){
  //     $user = User::first();
  //     return view('admin.users.index',[
  //         'user'=>$user
  //     ]);
  // }


  // -- com compact -- //
  // sem pagination 
  // public function index (){
  //     $users = User::all();


  //     return view('admin.users.index',compact('users'));
  // }



  public function index()
  {
    $users = User::Paginate(15);


    return view('admin.users.index', compact('users'));
  }

  public function create()
  {

    return view('admin.users.create');
  }


  public function store(StoreUserRequest $request)
  {
    // dd($request->all()); // pega todos os dados
    // dd($request->only('_token')); // token pega apenas um dado da requisição.
    // dd($request->except('_token'));
    User::create($request->validated());
    return redirect()
      ->route('users.index')
      ->with('success', 'Usuário criado com sucesso');
  }


  public function edit(string $id)
  {
    // $user =  User::where('id','=', $id)->first();
    // $user = User::where('id',$id)->first(); // ->firstOrFail muito usado nas API
    //$user = User::find($id);
    if (!$user = User::find($id)) {
      return redirect()->route('users.index')->with('message', 'O usuario não foi encontrado...');
    }
    return view('admin.users.edit', compact('user'));
  }

  public function update(UpdateUserRequest $request, string $id)
  {
    if (!$user = User::find($id)) {
      return back()->with('message', 'O usuario não foi encontrado...');
    }
    $data = $request->only('name', 'email');
    if ($request->password) {
      $data['password'] = bcrypt($request->password);
    }
    dd($data);
    $user->update($request->only([
      'name',
      'email'
    ]));

    return redirect()->route('users.index')->with('success', 'Usuário Editado com sucesso!');

  }

  public function show(string $id)
  {

    if (!$user = User::find($id)) {
      return redirect()->route('users.index')->with('message', 'Usuário não encontrado');
    }
    return view('admin.users.show', compact('user'));
  }

  public function destroy(string $id)
  {
      // if (Gate::denies('is-admin')) {
      //     return back()->with('message', 'Você não é um administrador');
      // }
      if (!$user = User::find($id)) {
          return redirect()->route('users.index')->with('message', 'Usuário não encontrado');
      }
      if (Auth::user()->id === $user->id) {
        
        return back()->with('message', 'Você não pode deletar o seu próprio perfil');
      }
      $user->delete();

      return redirect()
          ->route('users.index')
          ->with('success', 'Usuário deletado com sucesso');
  }


}

// return $User = {
//     "id": 21,
//     "name": "iagojoseph",
//     "email": "iagojosephqt@gmail.com",
//     "email_verified_at": null,
//     "created_at": "2024-07-20T02:46:13.000000Z",
//     "updated_at": "2024-07-20T02:46:13.000000Z"
//   }
