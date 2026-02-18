<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {

    }



    // Hiển thị danh sách category
    public function index(Request $request){

        // if(isset($_GET['id'])){
        //     echo $_GET['id'];
        // }


        // $path = $request->path();
        // echo $path;

        // $url = $request ->url();
        // echo $url;
        $method = $request -> method();
        // echo $method;
        // $ip = $request ->ip();
        // echo $ip;
        //  $id = $request->input('id');
        // dd($id);
        // $data = $request->all();
        // dd($data);
        $query =$request ->query();
        dd($query);

        return view('clients/categories/list');
    }


    // Lấy 1  category theo id
    public function getCategory($id){
        return view('clients/categories/edit');
     }

     // Cập nhật category theo id
        public function updateCategory($id){
            return "Cập nhật category có id = $id";
         }
     // Thêm mới category
     public function addcategory(Request $request){
        // $path = $request->path();
        // echo $path;

        // $catename = $request->old('category_name');

       return view('clients/categories/add');
     }
     public function hanleAddCategory(Request $request){

         $catename =$request->category_name;
        //  dd($catename);

        if($request->has('category_name')){
            $catename =$request -> category_name;
            $request->flash();
        }
        return redirect(route('categories.add'));
        // return "Xử lý thêm mới category";
     }

     // Xoá category theo id
     public function deletecategory($id){
        return "Xoá category có id = $id";
     }
     // form upload
     public function getfile(Request $request){
    //     $data =[];
    //    echo $request;
      $viewfile = 'clients/categories/file';
      return view($viewfile);
     }
     // Xử lý lấy thông tin file
     public function handleFile(Request $request){

    //    $file = $request->file('photo');
    if($request->hasFile('photo')){
        if($request->file('photo')->isValid()){
             $file = $request->photo;
             // lấy đường dẫn tạm
            // $path = $file->path();
            // lấy đuôi file
            // $ext = $file->extension();
            // dd($ext);
            $path = $file->store('images');
            dd($path);
        }
     }else{
        return 'Vui lòng chọn file';
     }
    }
}