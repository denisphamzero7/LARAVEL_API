<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Sanctum\PersonalAccessToken;
use PhpParser\Node\Stmt\Else_;

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
        $email = $request->email;
        $password = $request->password;
        $checklogin = Auth::attempt([
            'email' => $email,
            'password' => $password,
        ]);
        if ($checklogin) {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            $token = $user->createToken('auth_token')->accessToken;
            $response = [
                'status' => 200,
                'message' => 'Đăng nhập thành công',
                'token' => $token,
            ];
        } else {
            $response = [
                'status' => 404,
                'message' => 'Đăng nhập thất bại',
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
    public function getToken(Request $request)
    {
        $deleted = $request->user()->token()->revoke();

        if ($deleted) {
            return response()->json([
                'status' => 200,
                'message' => 'Token đã bị thu hồi',
            ], 200);
        };
    }
    public function refreshToken(Request $request)
    {
        $hashToken = $request->header('Authorization');
        $hashToken = str_replace('Bearer ', '', $hashToken);
        $hashToken = trim($hashToken);
        $token = PersonalAccessToken::findToken($hashToken);
        if ($token) {
            $tokenCreatedAt = $token->created_at;
            $expire = Carbon::parse($tokenCreatedAt)->addMinutes(config('sanctum.expiration'));
            if (Carbon::now()>=$expire) {
                $userId = $token->tokenable_id;
                $user = User::find($userId);
                $user->tokens()->delete();
                $newToken = $user->createToken('auth_token')->plainTextToken;
                $response = [
                    'status' => 200,
                    'message' => 'Token đã được làm mới',
                    'token' => $newToken,
                ];
            }else{
                $response=[
                    'status' => 400,
                    'message' => 'Expire chưa hết, không cần làm mới token',
                ];
            }


        }else{
            $response=[
                'status' => 404,
                'message' => 'Token không hợp lệ',
            ];
            return response()->json($response, 404);
        };
        return response()->json($response, 200);
    }
}
