<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    protected function guard()
    {
        return Auth::guard('web');
    }

    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email'    => 'required',
                'password' => 'required|string',
            ]
        );

        if ($validator->fails()) {
            $response = [
                'status'    => false,
                'error'     => $validator->errors(),
            ];

            return response()->json($response, 200);
        } else {

                $token_validity = (8760 * 60);
                $this->guard()->factory()->setTTL($token_validity);

                $user    = User::where('email', $request->email)->first();

                if ($user) {
                    if (!$token = $this->guard()->attempt(['email' => $request->email, 'password' => $request->password])) {
                        if (!password_verify($request->password, $user->password)) {
                            $response = [
                                'password'   => false,
                                'error'      => [
                                    'password' => ['Wrong password']
                                ],
                            ];

                            return response()->json($response, 200);
                        }
                    }

                    if(!$user->email_verified_at){
                        $response = [
                            'mail'      => false,
                            'error'     => [
                                'email' => 'please verify email'
                            ],
                        ];

                        return response()->json($response, 200);
                    }
                    return $this->respondWithToken($token);
                    
                } else {
                    $response = [
                        'account'   => false,
                        'error'     => [
                            'email'      => ['The email is not registered yet']
                        ],
                    ];

                    return response()->json($response, 200);
                }
        }
    }
    
    protected function respondWithToken($token,$status = true)
    {
        config()->set('jwt.ttl', 60*24*7);
        return response()->json(
            [
                'success'        => $status,
                'token'          => $token,
                'token_type'     => 'bearer',
                'token_validity' => ($this->guard()->factory()->getTTL()),
                'name'           => $this->guard()->user()->first_name.' '.$this->guard()->user()->last_name,
                'email'          => $this->guard()->user()->email,
                'uid'            => $this->guard()->user()->uid
            ]
        );

    }
}
