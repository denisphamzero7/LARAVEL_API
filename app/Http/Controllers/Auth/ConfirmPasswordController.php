<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth; // Import chuẩn

class ConfirmPasswordController extends Controller
{
    use ConfirmsPasswords;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function validationErrorMessages()
    {
        return [
            'password.required' => 'Mật khẩu không để trống',
            'password.confirmed' => 'Mật khẩu không khớp',
            // Lưu ý: rule 'confirmed' chỉ chạy nếu form có field password_confirmation
        ];
    }

    public function confirm(Request $request)
    {
        // 1. Validate: Kiểm tra pass nhập vào có đúng là pass của user không
        // Nếu sai, nó sẽ tự redirect về form, code bên dưới KHÔNG chạy.
        $request->validate($this->rules(), $this->validationErrorMessages());

        // 2. Nếu chạy xuống đây, tức là Pass đúng. Lấy User.
        $user = Auth::user();

        // 3. Reset timeout
        $this->resetPasswordConfirmationTimeout($request);

        // 4. Gửi mail
        // Kiểm tra chắc chắn có email để tránh lỗi
        if ($user && $user->email) {
            $content = 'Chào ' . ($user->name ?? 'Bạn') . '<br/>';
            $content .= 'Bạn vừa xác nhận mật khẩu thành công';

            Mail::html($content, function ($message) use ($user) {
                $message->to($user->email)
                        ->subject('Xác nhận mật khẩu thành công');
            });
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }
}
