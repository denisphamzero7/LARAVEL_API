<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Groups;
use Illuminate\Support\Facades\Auth;
use  App\Models\Modules;
class GroupsController extends Controller
{
    //
    public function index()
    {
         $userId = Auth::user()->id;
         // if(Auth::user()->user_id==0){
           $lists = Groups::all();
         // }else{
         //    $lists = Groups::where('user_id', $userId)->get();
         // }

        return view('admin.groups.list', compact('lists'));
    }
    public function add()
    {
        $this->authorize('create', Groups::class);
        return  view('admin.groups.add');
    }
    public function postadd(Request $request)
    {
        $this->authorize('create', Groups::class);

        $request->validate(
            [
                'name' => 'required|string|unique:groups,name',
            ],
            [
                'name.required' => 'Trường :attribute bắt buộc phải nhập',
                'name.unique' => 'Tên  trùng, vui lòng chọn lại',
            ]
        );
        $groups = new Groups();
        $groups->name = $request->name;
        // Gán giá trị cho trường 'description' để tránh lỗi SQL
        $groups->user_id = Auth::user()->id;
        $groups->description = $request->description ?? '';
        $groups->save();
        return redirect()->route('admin.groups.index')->with('msg', 'thêm thành công');
    }

    public function edit( Groups $group)
    {
        $this->authorize('update', $group);
        return  view('admin.groups.edit', compact('group'));
    }
    public function postedit(Request $request, Groups $group){
        $this->authorize('update', $group);
        $request->validate(
            [
                'name' => 'required|string|unique:groups,name,'.$group->id,
            ],
            [
                'name.required' => 'Trường :attribute bắt buộc phải nhập',
                'name.unique' => 'Tên nhóm đã tồn tại, vui lòng chọn lại',
            ]
        );
        $group->name = $request->name;
        $group->description = $request->description ?? '';
        $group->save();
        return redirect()->route('admin.groups.index')->with('msg','Cập nhật nhóm thành công');
    }
    public function delete(Groups $group){
        $this->authorize('delete', $group);
        $userCount= $group->users->count();
        if($userCount==0){
        $group->delete();
        return redirect()->route('admin.groups.index')->with('msg', 'Xóa nhóm thành công.');
        }
        return redirect()->route('admin.groups.index')->with('msg', 'Trong nhóm vẫn còn :'. $userCount.' người dùng');
    }
    public function permission(Groups $group){
        $this->authorize('permission', $group);
        $modules = Modules::all();
        $roleListArray =[
            'view'=>'Xem',
            'add'=>'Thêm',
            'edit'=>'Sửa',
            'delete'=>'Xóa',
        ];

        $roleArr = [];
        if (!empty($group->permissions)) {
            $roleArr = json_decode($group->permissions, true);

        }

        return view('admin.groups.permission', compact('group', 'modules', 'roleListArray', 'roleArr'));
    }
    public function postpermission(Request $request,Groups $group){
        $this->authorize('permission', $group);
        if(!empty($request->role)){
            $roleArr= $request->role;
        }
         else{
            $roleArr=[];
         }
         $roleJson =json_encode($roleArr);
         $group->permissions = $roleJson;
         $group->save();
         return back()->with('msg','Cập nhật thành công');
    }
}
