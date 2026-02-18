<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Uppercase implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Logic: Chuyển giá trị nhập vào sang chữ hoa (mb_strtoupper hỗ trợ tiếng Việt)
        // Sau đó so sánh với giá trị gốc. Nếu khác nhau nghĩa là người dùng có nhập chữ thường.
        if (mb_strtoupper($value, 'UTF-8') !== $value) {
            // Gọi $fail để báo lỗi
            $fail('Trường :attribute bắt buộc phải viết hoa.');
        }
    }
}
