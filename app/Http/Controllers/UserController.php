<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    // Index
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('users.index', compact('users'));
    }

    // Store
    public function saveUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        
        return response()->json([
            'user' => $user,
            'success' => 'Usuario creado con éxito',
        ]);
    }

    // Edit - Retrieve the user data by id
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    // Update the user data
    public function userUpdate(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        
        return response()->json([
            'user' => $user,
            'success' => 'Usuario actualizado con éxito',
        ]);
    }

    public function userDelete($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'success' => 'Usuario eliminado con éxito',
        ]);
    }
}
