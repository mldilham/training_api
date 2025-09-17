<?php

namespace App\Http\Controllers\Api;
// use App\Http\Controllers\Api\UserController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json([
            'number_of_user' => $users->count(),
            'data' => $users,
        ],200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:50|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return response()->json([
            'message' => 'User created successfully',
            'data' => $user
        ],201);
    }

    public function show(string $id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($user, 200);
        }else
        {
            return response()->json(['message' => 'User not found '], 404);
        }
    }

    public function update(Request $request,string $id)
    {

        $validator = Validator::make($request->all(),[
            'name' => 'sometimes|string|max:50',
            'email' => 'sometimes|string|email|max:50|unique:users,email,' . $id,
            'password' => 'sometimes|string|min:8',
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors(),422);
        }

        $user = User::find($id);

        if($user)
        {
            $user->update([
                'name' => $request->name ?? $user->name,
                'email' => $request->email ?? $user->email,
                'password' => $request->password ? bcrypt($request->password) : $user->password,
            ]);

            return response()->json([
                'message' => 'User updated successfully',
                'data' => $user,
            ],200);

        }else
        {
            return response()->json(['message' => 'User not found'],408);
        }
    }

    public function destroy(string $id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully'], 200);
        }else
        {
            return response()->json(['message' => 'User not found'],404);
        }
    }
}

