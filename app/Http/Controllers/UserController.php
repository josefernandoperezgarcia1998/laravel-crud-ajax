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

        $validator = validator($request->all(), [
            'img' => 'mimes:jpeg,png,gif|max:3000',
        ]);
        
        if($validator->fails())
        {
            return response()->json([
                'error' => 'Error en validación de imagen'
            ]);
        }
        
        $img = NULL;
        
        if($request->hasFile('image')){
            $imagen = $request->file('image');
            $nombre_de_imagen = $imagen->getClientOriginalName();
            $img = $request->file('image')->storeAs('uploads/user-images/image', $nombre_de_imagen, 'public');
        }
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $img;
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
