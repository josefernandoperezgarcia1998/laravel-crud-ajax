<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return view('users.index', compact('users'));
    }

    public function saveUser(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        
        return response()->json($user);
    }

    public function getUserData()
    {
        $usersData = User::latest('id')->get();
        return json_encode( array( 'data' => $usersData ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // User::create($request->all());
        // return response()->json(['success'=>'Usuario creado con éxito']);



        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required|numeric|digits:8',
        // ]);
        
        // if ($validator->fails()) {
        //     return response()->json(array('errors' => $validator->getMessageBag()));
        // }


        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        User::create($request->all());
        // return json_encode(
        //     array(
        //         "statusCode" => 200, 
        //         'message' => 'Usuario registado con éxito',
        //         )
        // );
        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function userUpdate(Request $request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        
        return response()->json($user);
    }

    public function userDelete($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'success' => 'Usuario eliminado con éxito',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        
        return json_encode(array('statusCode'=>200));
    }

    public function dataAjax(Request $request)
    {
        $data = User::get();

        if($request->has('q')){
            $search = $request->q;
            $data = User::select("id","name")
                        ->where('name','LIKE',"%$search%")
                        ->get();
        }
        return response()->json($data);
    }
}
