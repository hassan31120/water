<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'number' => 'required|numeric',
            'password' => 'required',
            'password_confirmation' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return $this->sendError('please Validate error', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('mohammedhassanwater')->accessToken;
        $success['name'] = $user->name;

        return $this->sendResponse($success, 'User has registered successfully');
    }

    public function login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            $success['token'] = $user->createToken('mohammedhassanwater')->accessToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success, 'User has login successfully');
        } else {
            return response()->json(
                [
                    'success' => false,
                    'data' => [],
                    'message' => 'Please Check your credentials' ,
                ],
                200
            );
            //  return $this->sendError('please Check your cordinates', ['error' => 'Unauthorized']);
        }
    }
}
