<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:70',
            'email' => 'required|unique:users,email|max:90',
            'password' => [
                'required',
                'string',
                Password::min(4)
                    ->mixedCase()      // At least one uppercase and one lowercase letter
                    ->numbers()        // At least one number
                    ->symbols()        // At least one symbol
                    ->uncompromised(), // Checks against known data breaches
            ]
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ]);
        }

        $user =  new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json([
            "success" => true,
            "message" => "User registered successfully"
        ]);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ]);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "success" => false,
                "message" => "Invalid email or password",
                "token" => null
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            "success" => true,
            "message" => "User loggedIn successfully",
            "token"=>$token
        ]);
    }
}
