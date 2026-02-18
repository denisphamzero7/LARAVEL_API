<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
     public function __construct(){

    }
    const _PER_PAGE=5;
    public function index(){
        // $allPost = Post::all();
        // dd($allPost);
        // $post = Post::find(1);
        // dd($post);
        // $post = new Post;
        // $post->title='Tiêu đề 1';
        // $post->content='Nội dung 1';
        // $post->save();

        // echo '<h2> Học eloquent Model';
        // $allPost= Post::all();
        // if($allPost->count()>0){
        //     foreach($allPost as $item){
        //         echo $item->title.'</br>';
        //     }
        // }
        $title='Trang QUẢN LÍ TIN TỨC';
        $allPost=Post::paginate(self::_PER_PAGE);

        return view('clients.post.list',compact('title','allPost'));
    }
    public function add(){
        $dataInsert=[
            'title'=>"Bộ Y tế yêu cầu khẩn trương điều tra vụ nghi ngộ độc bánh mì ở TPHCM",
            'content'=>'Về vụ việc nhiều người nhập viện với triệu chứng đau bụng, tiêu chảy sau khi ăn bánh mì tại phường Phú Mỹ, Cục An toàn thực phẩm (Bộ Y tế) yêu cầu Sở An toàn thực phẩm TPHCM khẩn trương điều tra, làm rõ nguyên nhân.',
            'status'=>1,
        ];
        // $post = Post::create($dataInsert);
        // dd($post);
        // $insert= Post::insert($dataInsert);
        // dd($insert);
        // $post = Post::firstOrCreate([
        //     'id'=>12
        // ],$dataInsert);
        $post = new Post;
       $post->title = $dataInsert['title'];   // Truy xuất phần tử mảng dùng ngoặc vuông
       $post->content = $dataInsert['content'];
        $post->save();
        dd($post);
    }

    public function update($id){
           // Tạo đối tượng cho bản ghi hiển tại
           $post = Post::find($id);
        //   $post->title = 'bài viết hau';
        //   $post->save();
        //   dd($post);
        $dataUpdate=[
            'title'=>'Bài mới nhé ',
            'content'=>'Bài liên quan đến'
        ];
        // $status=$post->update($dataUpdate);
        $status = Post::where('id',$id)->update($dataUpdate);
         dd($status);
        }

    public function delete($id){
        // $status = Post::destroy($id);
        $status = Post::where('id',$id)->delete();
        dd($status);
    }
    public function deleteAny(Request $request)
    {
        // Lấy mảng id từ checkbox gửi lên (name="delete[]")
        $ids = $request->input('delete');

        // Kiểm tra xem có chọn cái nào không
        if (!empty($ids) && is_array($ids)) {
            // Cách 1: Dùng destroy (nhanh gọn)
            Post::destroy($ids);

            // Cách 2: Dùng whereIn (nếu muốn logic phức tạp hơn)
            // Post::whereIn('id', $ids)->delete();

            $msg = 'Đã xóa ' . count($ids) . ' bài viết thành công';
        } else {
            $msg = 'Vui lòng chọn ít nhất một mục để xóa';
        }

        return redirect()->back()->with('msg', $msg);
    }
}
