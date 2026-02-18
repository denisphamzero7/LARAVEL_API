<?php

namespace App\Http\Controllers\Auth;
use App\Providers\AppServiceProvider;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
   // ghi đè phương thức logout để chuyển hướng về trang login
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->route('login');
    }
    // Muốn ghi đè validateLogin thì làm như sau
     protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string|email',
            'password' => 'required|string|min:6',
        ], [
            $this->username().'.required'=>'Trường :attribute bắt buộc phải nhập',
            $this->username().'.string'=>'Trường :attribute Không hợp lệ',
            $this->username().'.email'=>'Trường :attribute phải đúng định dạng',
            'password.required'=>'Trường :attribute bắt buộc phải nhập',
            'password.string'=>'Trường :attribute Không hợp lệ',
            'password.min'=>'Trường :attribute phải lớn hơn :min kí tự',
        ]);
    }
}
