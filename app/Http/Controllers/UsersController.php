<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserStoreRequest;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(Request $request)
    {
        return view('users.index', [
            "users" => User::latest()->paginate()
        ]);
    }

    public function store(UserStoreRequest $request)
    {
        $user = User::create($request->all());

        $request->session()->flash('user.name', $user->name);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}
