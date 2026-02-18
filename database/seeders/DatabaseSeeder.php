<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PostSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // $this->call([
        //     UserSeeder::class,
        //     PostSeeder::class,
    //     // ]);
    // DB::statement('SET FOREIGN_KEY_CHECKS=0');
    // $groupId = DB::table('groups')->insertGetId([
    //     'name' => 'Administrator',
    //     'description' => 'System Administrator Group',
    //     // 'permissions' => json_encode(['admin.access' => true]),
    //     'user_id' => 0,
    //     'created_at' => now(),
    //     'updated_at' => now(),
    // ]);
    //  DB::statement('SET FOREIGN_KEY_CHECKS=1');
    //  if ($groupId>0){
    //     $userId =DB::table('users')->insert([
    //         'name' => 'hau',
    //         'email' => 'hau@gmail.com',
    //         'password'=>Hash::make('123456'),
    //         'group_id' => $groupId,
    //         'user_id' => 0,
    //         'created_at' => now(),
    //         'updated_at' => now(),
    //         ]);
    //     if($userId>0){
    //              for ($i=1;$i<=5;$i++){
    //               DB::table('posts')->insert([
    //              'title'=>'Lorem Ipsum',
    //              'content'=>'Lorem Ipsum chỉ đơn giản là văn bản giả được sử dụng trong ngành in ấn và sắp chữ. Lorem Ipsum đã là văn bản giả tiêu chuẩn của ngành này kể từ những năm 1500, khi một người thợ in không rõ danh tính đã lấy một bản in thử và xáo trộn các chữ cái để tạo ra một cuốn sách mẫu chữ. Nó không chỉ tồn tại qua năm thế kỷ mà còn vượt qua cả bước tiến vào lĩnh vực sắp chữ điện tử, về cơ bản vẫn không thay đổi. Nó trở nên phổ biến vào những năm 1960 với sự ra mắt của các tờ giấy Letraset có chứa các đoạn văn Lorem Ipsum, và gần đây hơn với phần mềm xuất bản trên máy tính để bàn như Aldus PageMaker bao gồm các phiên bản của Lorem Ipsum.',
    //              'user_id'=>$userId,
    //              'created_at'=>now(),
    //              'updated_at'=>now(),
    //            ]);
    //              }
    //     };

    //  };
    DB::table('modules')->insert(
        [
            'name'=>'users',
            'title'=>'Quản lý người dùng',
            'description'=>'Quản lý người dùng',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]
    );

     DB::table('modules')->insert(
        [
            'name'=>'groups',
            'title'=>'Quản lý nhóm',
            'description'=>'Quản lý nhóm',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]
    );
     DB::table('modules')->insert(
        [
            'name'=>'posts',
            'title'=>'Quản lý bài viết',
            'description'=>'Quản lý bài viết',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]
    );

    }
}
