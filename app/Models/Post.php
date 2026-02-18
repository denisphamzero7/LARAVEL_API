<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Categories;
use App\Models\Comments; // ĐÚNG: App viết thường, Models có s
use App\Models\Votes;
class Post extends Model
{   // Sử dụng sortdelete
    // use SoftDeletes;
    // Quy ước đặt tên table
    /*
    Tên Model: Post => table: posts
    Tên Model: ProctCategory: product_categories
    */
    // đặt tên table
    protected $table ='posts';
    public function postBy(){
        return $this->belongsTo(User::class,'user_id','id');
    }


}
