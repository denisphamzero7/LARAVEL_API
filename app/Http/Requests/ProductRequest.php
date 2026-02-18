<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\authorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;
class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'product_name'=>'required|min:6',
        'product_price'=>'required|integer'
        ];
    }
    public function messages(){
        return[
        'product_name.required'=>'Trường :attribute bắt buộc phải nhập',
        'product_name.min'=>'Tên đăng nhập không nhỏ hơn :min kí tự',
        'product_price.integer'=>'Trường :attribute phải số',
        'product_price.required'=>'Trường :attribute bắt buộc phải nhập',
        ];
    }
    // thay đổi tên trường
     public function attributes(){
        return [
            'product_name'=>'tên sản phẩm',
            'product_price'=>'Giá sản phẩm'
        ];
     }
     public function after(): array
{
    return [
        function (Validator $validator) {

            if($validator->errors()->count()>0){
                 $validator->errors()->add(
                    'msg',
                    'Đã có lỗi sảy ra'
                );
            }

                // $validator->errors()->add(
                //     'msg',
                //     'Đã có lỗi sảy ra'
                // );

        }
    ];
}

protected function prepareForValidation(){
    $this->merge([
        'create_at'=>date('Y-m-d H:i:s')
    ]);
}
// format khi không có quyền
protected function failedAuthorization(){
    // throw new AuthorizationException(' Bạn đéo có quyền');
    // chuyển hướng
//    throw new HttpResponseException(redirect('/')->with('msg','Bạn tuổi gì có quyền')->with('type','danger'));
throw new HttpResponseException(abort(404));
}
}
