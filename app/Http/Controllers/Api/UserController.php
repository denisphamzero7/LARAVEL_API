<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Danh sách user',
            'data' => $users
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {    
        $rules=[
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6',
        ];
        $messages=[
            'name.required'=>'Tên không được để trống',
            'email.required'=>'Email không được để trống',
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Mật khẩu không được để trống',
            'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự',
        ];
        $request->validate($rules,$messages);
        
        $user = User::create($request->all());
        
        return response()->json([
            'status' => 'success',
            'message' => 'Tạo user thành công',
            'data' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Chi tiết user',
            'data' => $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules=[
            'name'=>'sometimes|required',
            'email'=>'sometimes|required|email|unique:users,email,'.$user->id,
            'password'=>'sometimes|required|min:6',
        ];
        $messages=[
            'name.required'=>'Tên không được để trống',
            'email.required'=>'Email không được để trống',
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Mật khẩu không được để trống',
            'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự',
        ];
        $request->validate($rules,$messages);
        
        $user->update($request->all());
        
        return response()->json([
            'status' => 'success',
            'message' => 'Cập nhật user thành công',
            'data' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Xóa user thành công',
        ], 200);
    }
}
