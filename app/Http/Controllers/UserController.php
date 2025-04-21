<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        $userData = $request->validated();
        $userData['password'] = bcrypt($userData['password']); // Hash da senha

        User::create($userData);

        return redirect()->route('users.index')->with('success', 'Usuário cadastrado com sucesso!');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(5);
        return view('users.index', compact('users'))
            ->with(request()->input('page'));
    }
    public function create()
    {
        return view('users.create');
    }

}
