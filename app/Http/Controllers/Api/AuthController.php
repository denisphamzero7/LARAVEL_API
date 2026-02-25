<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Laravel\Sanctum\PersonalAccessToken;
use PhpParser\Node\Stmt\Else_;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
    }
    public function index()
    {
        //
    }
      public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        // auth('api')->invalidate();
        $refreshToken = $this->createRefreshToken();
        return $this->respondWithToken($token, $refreshToken);
    }
    protected function respondWithToken($token,$refreshToken)
    {
        return response()->json([
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
     public function createRefreshToken(){
        
        $data = [
            'sub' => auth('api')->user()->id,
            'random'  => rand() . time(),
            'exp'     => time() + config('jwt.refresh_ttl') * 60,
        ];
        $refreshToken = JWTAuth::getJWTProvider()->encode($data);
        return $refreshToken;
    }
    public function profile()
    {
        try {
            // Ép buộc kiểm tra token (bao gồm cả blacklist)
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'User không tồn tại'], 404);
            }
            return response()->json($user);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Token không hợp lệ hoặc đã bị vô hiệu hóa (Blacklisted)'], 401);
        }
    }
    public function logout(){
       auth()->logout();
       return response()->json([
        'message' => 'Successfully logged out',
       ]);
    }
    // public function login(Request $request)
    // {
    //     //
    //     $email = $request->email;
    //     $password = $request->password;
    //     $checklogin = Auth::attempt([
    //         'email' => $email,
    //         'password' => $password,
    //     ]);
    //     if ($checklogin) {
    //         /** @var \App\Models\User $user */
    //         $user = Auth::user();

    //         // $token = $user->createToken('auth_token')->accessToken;: sanctum
    //         $tokenRessult = $user->createToken('auth_api');
    //         $token= $tokenRessult->token;
    //         $token->expires_at = Carbon::now()->addMinutes(60);
    //         $expires=Carbon::parse($token->expires_at)->toDateTimeString();
    //         $accessToken = $tokenRessult->accessToken;
    //         $response = [
    //             'status' => 200,
    //             'message' => 'Đăng nhập thành công',
    //             'token' => $accessToken,
    //             'token_type'=>'Bearer',
    //             'expires_at'=>$expires,
    //         ];
    //     } else {
    //         $response = [
    //             'status' => 404,
    //             'message' => 'Đăng nhập thất bại',
    //         ];
    //     }
    //     return $response;
    // }
  

    // passport : public function login(Request $request)
    // {
    //     //
    //     $email = $request->email;
    //     $password = $request->password;
    //     $checklogin = Auth::attempt([
    //         'email' => $email,
    //         'password' => $password,
    //     ]);
    //     if ($checklogin) {
    //         /** @var \App\Models\User $user */
    //         $user = Auth::user();

    //         // $token = $user->createToken('auth_token')->accessToken;: sanctum
    //         // $tokenRessult = $user->createToken('auth_api');
    //         // $token= $tokenRessult->token;
    //         // $token->expires_at = Carbon::now()->addMinutes(60);
    //         // $expires=Carbon::parse($token->expires_at)->toDateTimeString();
    //         // $accessToken = $tokenRessult->accessToken;
    //         $client = Client::where('grant_types', 'LIKE', '%password%')->first();
    //         if($client){
    //         $clientSecret = env('PASSPORT_CLIENT_SECRET');
    //         $clientId = env('PASSPORT_CLIENT_ID');
    //         $response = Http::asForm()->post('http://127.0.0.1:8001/oauth/token', [
    //             'grant_type' => 'password',
    //             'client_id' => $clientId,
    //             'client_secret' =>$clientSecret, // Required for confidential clients only...
    //             'username' => $email,
    //             'password' => $password,
    //             'scope' => '',
    //         ]);
    //         return $response;
    //         // $response = [
    //         //     'status' => 200,
    //         //     'message' => 'Đăng nhập thành công',
    //         //     'token' => $accessToken,
    //         //     'token_type'=>'Bearer',
    //         //     'expires_at'=>$expires,
    //         // ];
    //         }
    //     } else {
    //         $response = [
    //             'status' => 404,
    //             'message' => 'Đăng nhập thất bại',
    //         ];
    //     }
    //     return $response;
    // }
  
  
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
        $deleted = $request->user('api')->token()->revoke();

        if ($deleted) {
            return response()->json([
                'status' => 200,
                'message' => 'Token đã bị thu hồi',
            ], 200);
        };
    }
    // public function refreshToken(Request $request)
    // { sanctum
    //     $hashToken = $request->header('Authorization');
    //     $hashToken = str_replace('Bearer ', '', $hashToken);
    //     $hashToken = trim($hashToken);
    //     $token = PersonalAccessToken::findToken($hashToken);
    //     if ($token) {
    //         $tokenCreatedAt = $token->created_at;
    //         $expire = Carbon::parse($tokenCreatedAt)->addMinutes(config('sanctum.expiration'));
    //         if (Carbon::now()>=$expire) {
    //             $userId = $token->tokenable_id;
    //             $user = User::find($userId);
    //             $user->tokens()->delete();
    //             $newToken = $user->createToken('auth_token')->plainTextToken;
    //             $response = [
    //                 'status' => 200,
    //                 'message' => 'Token đã được làm mới',
    //                 'token' => $newToken,
    //             ];
    //         }else{
    //             $response=[
    //                 'status' => 400,
    //                 'message' => 'Expire chưa hết, không cần làm mới token',
    //             ];
    //         }


    //     }else{
    //         $response=[
    //             'status' => 404,
    //             'message' => 'Token không hợp lệ',
    //         ];
    //         return response()->json($response, 404);
    //     };
    //     return response()->json($response, 200);
    // }
    public function refresh()
    {
        $refreshToken = request()->refresh_token;
        try {
            // 1. Giải mã refresh token để lấy user
            $decode = JWTAuth::getJWTProvider()->decode($refreshToken);
            $user = User::find($decode['sub']);

            if (!$user) {
                return response()->json([
                    'message' => 'Người dùng không tồn tại',
                ], 404);
            }

            // 2. VÔ HIỆU HÓA Access Token cũ (Blacklist)
            // Client nên gửi Access Token cũ trong Header Authorization để server có thể hủy nó
            try {
                auth('api')->invalidate(true);
            } catch (\Exception $e) {
                // Bỏ qua nếu token cũ không tồn tại hoặc đã bị hủy trước đó
            }

            // 3. Tạo Access Token mới và Refresh Token mới (Rotation)
            $token = auth('api')->login($user);
            $newRefreshToken = $this->createRefreshToken();

            return $this->respondWithToken($token, $newRefreshToken);
        } catch (JWTException $e) {
            return response()->json([
                'message' => 'Refresh Token không hợp lệ hoặc đã hết hạn',
            ], 401);
        }
    }
   
    // refresh passport
    // public function refreshToken(Request $request) 
    // {
    //     // 1. Check if refresh_token is present
    //     if (!$request->has('refresh_token')) {
    //         return response()->json([
    //             'status' => 400,
    //             'message' => 'Thiếu refresh_token trong request',
    //         ], 400);
    //     }

    //     // 2. Get Client Credentials from .env
    //     $clientId = env('PASSPORT_CLIENT_ID');
    //     $clientSecret = env('PASSPORT_CLIENT_SECRET');

    //     // 3. Create Internal Request to /oauth/token
    //     // Using app()->handle() avoids network issues and timeouts on local server
    //     $tokenRequest = Request::create(
    //         '/oauth/token',
    //         'POST',
    //         [
    //             'grant_type' => 'refresh_token',
    //             'refresh_token' => $request->refresh_token,
    //             'client_id' => $clientId,
    //             'client_secret' => $clientSecret,
    //             'scope' => '',
    //         ]
    //     );

    //     $tokenRequest->headers->set('Accept', 'application/json');
    //     $tokenRequest->headers->set('Content-Type', 'application/x-www-form-urlencoded');

    //     // 4. Dispatch Request internally
    //     $response = app()->handle($tokenRequest);
    //     $content = json_decode($response->getContent(), true);

    //     // 5. Check Response
    //     if ($response->getStatusCode() == 200) {
    //         return response()->json([
    //             'status' => 200,
    //             'message' => 'Làm mới token thành công',
    //             'data' => $content
    //         ], 200);
    //     }

    //     return response()->json([
    //         'status' => $response->getStatusCode(),
    //         'message' => 'Không thể làm mới token. Vui lòng đăng nhập lại.',
    //         'error' => $content
    //     ], $response->getStatusCode());
    // }
}
