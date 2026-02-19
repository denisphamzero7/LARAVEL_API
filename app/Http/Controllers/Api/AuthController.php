<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function login(Request $request)
    {
        //
         $email=$request->email;
         $password=$request->password;
        $checklogin = Auth::attempt([
            'email' => $email,
            'password' => $password,
         ]);
         if($checklogin){
            /** @var \App\Models\User $user */
            $user = Auth::user();

            $token = $user->createToken('auth_token')->plainTextToken;
           $response = [
            'status'=>200,
            'message'=>'Đăng nhập thành công',
            'token'=>$token,
           ];
         }else{
           $response = [
            'status'=>404,
            'message'=>'Đăng nhập thất bại',
           ];
         }
         return $response;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
     public function getToken(Request $request){
        $deleted = $request->user()->currentAccessToken()->delete();

        if($deleted){
            return response()->json([
                'status' => 200,
                'message' => 'Token đã bị thu hồi',
            ], 200);
    };
    }
}
