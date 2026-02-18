<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    //

     public function index(){
         $userId = Auth::user()->id;
         // if(Auth::user()->user_id==0){
            $lists= User::all();
         // }else{
         //    $lists = User::where('user_id', $userId)->get();
         // }

        return view('admin.users.list',compact('lists'));
    }

    public function add(){
        $groups = Groups::all();
        return  view('admin.users.add',compact('groups'));
    }
    public function postadd(Request $request){
            $request -> validate(
                [
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users,email',
                     'password' => 'required|string|min:6',
                     'group_id' =>['required',function($attribute,$value,$fail){
                        if($value == 0){
                            $fail('Vui lòng chọn nhóm người dùng');
                        }
                     }]
                ],[
                    'name.required' => 'Trường :attribute bắt buộc phải nhập',
                    'name.string' => 'Trường :attribute không hợp lệ',
                    'email.required' => 'Trường :attribute bắt buộc phải nhập',
                    'email.email' =>'Email không đúng định dạng',
                    'email.unique' =>'Email đã tồn tại',
                    'password.required' => 'Trường :attribute bắt buộc phải nhập',
                    'password.string' => 'Trường :attribute không hợp lệ',
                    'password.min' => 'Trường :attribute phải lớn hơn :min kí tự',
                    'group_id.required' => 'Trường :attribute bắt buộc phải nhập',
                ]
            );
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->group_id = $request->group_id;
            $user->user_id= Auth::user()->id;
            $user->save();
            return redirect()->route('admin.users.index')->with('msg','thêm thành công');
    }
    public function edit(User $user){
        $this->authorize('update',$user);
        $groups = Groups::all();
        return view('admin.users.edit', compact('user','groups'));
    }
    public function postedit(Request $request, User $user){
        $this->authorize('update',$user);
        $request -> validate(
            [
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,'.$user->id,
                 'password' => 'nullable|string|min:6',
                 'group_id' =>['required',function($attribute,$value,$fail){
                    if($value == 0){
                        $fail('Vui lòng chọn nhóm người dùng');
                    }
                 }]
            ],[
                'name.required' => 'Trường :attribute bắt buộc phải nhập',
                'name.string' => 'Trường :attribute không hợp lệ',
                'email.required' => 'Trường :attribute bắt buộc phải nhập',
                'email.email' =>'Email không đúng định dạng',
                'email.unique' =>'Email đã tồn tại',
                'password.string' => 'Trường :attribute không hợp lệ',
                'password.min' => 'Trường :attribute phải lớn hơn :min kí tự',
                'group_id.required' => 'Trường :attribute bắt buộc phải nhập',
            ]
        );
        $user->name = $request->name;
        $user->email = $request->email;
        if(!empty($request->password)) $user->password = Hash::make($request->password);
        $user->group_id = $request->group_id;
        $user->save();
        return redirect()->route('admin.users.index')->with('msg','Cập nhật người dùng thành công');
    }
    public function delete(User $user){
        $this->authorize('delete',$user);
        // Không cho phép người dùng tự xóa tài khoản của chính họ
        if (Auth::user()->id === $user->id) {
            return redirect()->route('admin.users.index')->with('msg', 'Bạn không thể tự xóa chính mình.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('msg', 'Xóa người dùng thành công.');
    }
}
