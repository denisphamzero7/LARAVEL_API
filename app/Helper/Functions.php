<?php
use App\Models\Groups;
use App\Models\Doctors;
function isUppercase($value,$message,$fail){
    if($value!=mb_strtoupper($value,'UFT-8')){
        $fail($message);
    }
}

function getAllGroups(){
  // Khởi tạo đối tượng Groups mới rồi mới gọi hàm getAll
    $groups = new Groups();
    return $groups->getAll();
}

function isRole($dataArr,$moduleName,$role='view'){
    // Kiểm tra xem mảng quyền và module có tồn tại không
    if (!empty($dataArr[$moduleName])) {
        // Kiểm tra xem quyền đang xét ($role) có nằm trong danh sách các quyền của module đó không
        return in_array($role, $dataArr[$moduleName]);
    }
    // Nếu module không tồn tại trong mảng quyền, trả về false
    return false;
}
