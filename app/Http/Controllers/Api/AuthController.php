<?php

namespace App\Http\Controllers\Api;

use App\Models\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:5|max:255|confirmed',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user_rule = Rule::where('name', 'user')->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rule_id' => $user_rule->id,
            'country' => $request->country,
            'city' => $request->city,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // event(new Registered($user));

        $token = $user->createToken('token');

        return response()->json([
            'status' => true,
            'msg' => 'User Created Successfluy',
            'user' => new UserResource($user),
            'token' => $token->plainTextToken,
        ]);
    }


    public function signin(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string|min:5|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }


            $credentials = request(['email', 'password']);

            if (! Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 422,
                    'msg' =>  "These credentials do not match",
                ]);
            }

            $user = User::where('email', $request->email)->first();

            $token = $user->createToken('token')->plainTextToken;
            return response()->json([
                'status_code' => 200,
                'msg' => 'Login Successfluy',
                'user' => new UserResource($user),
                'token' => $token
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status_code' => 500,
                // 'message' => 'Error in login',
                'msg' => $e->getMessage(),
            ]);
        }
    }


    public function logout()
    {
        // return response()->json([
        //     'msg' => 'Logout Succesfluy',
        // ]);
        Auth::user()->tokens()->delete();
    }
}
