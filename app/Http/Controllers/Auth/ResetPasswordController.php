<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Validation\Rules;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

     protected function validationErrorMessages()
   {
     return [
          'token.required' => 'Token không để chỗ trống',
          'email.required' => 'Email không để trống',
          'email.email' => 'Email không đúng định dạng',
          'password.required' => 'Mật khẩu không để trống',
          'password.confirmed' => 'Mật khẩu không khớp',
          'password.min' => 'Mật khẩu ít nhất 6 ký tự',
     ];
   }
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
