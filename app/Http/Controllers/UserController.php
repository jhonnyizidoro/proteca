<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewUserRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\User;
use Auth;
use App\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    private $pageSize = 15;

    public function showUsers(Request $request)
    {
        $users = new User;
        if ($request->has('nome')){
            $users = $users->where('name', 'like', "%{$request->nome}%");
        }
        if ($request->has('status') && $request->status){
            $request->status == 'ativos' ? $status = true : $status = false;
            $users = $users->where('active', $status);
        }
        $users = $users->where('id', '!=', Auth::user()->id)->orderBy('name')->paginate($this->pageSize)->appends([
            'nome' => $request->nome,
            'status' => $request->status,
            'acesso' => $request->acesso,
        ]);
        if ($request->has('acesso') && $request->acesso){
            $request->acesso == 'admin' ? $unsetIfHasAdminRole = false : $unsetIfHasAdminRole = true;
            foreach ($users as $key => $user){
                if ($user->hasTheRole('admin') == $unsetIfHasAdminRole){
                    unset($users[$key]);
                }
            }
        }
        return view('admin.users')->with('users', $users);
    }

    public function showProfileForm()
    {
        return view('admin.profile');
    }

    public function registerUser(NewUserRequest $request)
    {
        $password = $this->generatePassword();
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($password)
        ]);
        if ($request->role == 'admin'){
            $user->assignRole('admin');
        }
        $user->assignRole('author');
        return redirect()->back()->with('status', "Usuário {$user->email} criado com sucesso, a senha para acessar o portal é: <b>{$password}</b>.");
    }

    public function updateProfile(UpdateUserProfileRequest $request)
    {
        if (Hash::check($request->current_password, Auth::user()->password)) {
            $user = Auth::user();
            $user->name = $request->name;
            if ($request->password){
                $user->password = bcrypt($request->password);
            }
            $user->update();
            return redirect()->route('admin.profile')->with('status', 'Dados alterados com sucesso.');
        }
        return redirect()->back()->with('status', 'A senha atual está incorreta.');
    }

    // Se o usuário está ativo, gero uma senha aleatória (para ele não logar) e desativo ele
    // Se ele está desativado, eu ativo ele e retorno a senha nova para login
    public function toggleUserActivation($id)
    {
        $user = User::find($id);
        if (Auth::user() == $user) {
            return redirect()->back()->with('status', 'Você não pode desativar seu próprio usuário.');
        }
        if ($user->active){
            $user->password = uniqid();
            $user->active = false;
            $user->update();
            return redirect()->back()->with('status', "Usuário <b>{$user->email}</b> desativado com sucesso.");
        } else {
            $password = $this->generatePassword();
            $user->password = bcrypt($password);
            $user->active = true;
            $user->update();
            return redirect()->back()->with('status', "Usuário <b>{$user->email}</b> ativado. A senha para acesso ao portal é: <b>{$password}</b>.");
        }
    }

    public function resetUserPassword($id)
    {
        $user = User::find($id);
        if (Auth::user() == $user) {
            return redirect()->back()->with('status', 'Para alterar sua senha, use a função localizada na barra superior.');
        }
        $password = $this->generatePassword();
        $user->password = bcrypt($password);
        $user->update();
        return redirect()->back()->with('status', "A nova senha de acesso para o usuário <b>{$user->email}</b> é: <b>{$password}</b>.");
    }

    private function generatePassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }
        return $result;
    }

}
