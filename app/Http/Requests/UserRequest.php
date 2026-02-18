<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $uniqueEmail ='unique:users';
        if(session('id')){
            $id =session('id');
            $uniqueEmail='unique:users,email,'.$id;
        }
        return [
             'fullname'=>'required|min:5',
    'email'=>'required|email|'.$uniqueEmail,
   'group_id' => ['required', 'integer', function($attribute, $value, $fail){ // Đã sửa 'integer'
            if($value == 0){
                $fail('Bắt buộc phải chọn nhóm');
            }
        }]
        ];
    }


public function messages(){
return [
 'fullname.required'=>'Vui lòng nhập tên',
'fullname.min'=>'Vui lòng nhập :min kí tự trở lên',
'email.required'=>' Vui lòng nhập email',
'email.email'=>'Email không đúng định dạng',
'email.unique'=>'Email đã tồn tại trên hệ thống',
'group_id.required'=>'Nhóm không được để trống',
'group_id.integer'=>'Nhóm không hợp lệ'
];
}
}
