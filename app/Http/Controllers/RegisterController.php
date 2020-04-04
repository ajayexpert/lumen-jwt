<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\User
   */
  public function register(Request $request)
  {
    $data = $request->all();

    $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'gate_pass' => ['required', 'min:8', 
                            function ($attribute, $value, $fail) {
                                if ($value != env('GATE_PASS')) {
                                    $fail($attribute.' is invalid.');
                                }
                            }
                        ]
        ]);


    $validator->validate();


    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
    ]);


    if (is_null($user)) {
      return response()->json([
                    "status" => 500, 
                    "response" => "unable to create user"
                ], 500);
    }

    return response()->json([
                    "status" => 200, 
                    "response" => "user is successfully created"
                ], 200);
    
  }

}
