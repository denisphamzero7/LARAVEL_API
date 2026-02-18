<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class Groups extends Model
{
    protected $table ='groups';

     public function users(){
    return $this->hasMany(
       User::class,
       'group_id','id'
    );}


    public function postBy(){
          return $this->belongsTo(User::class,'user_id','id');
    }

    public function getAll(){
        $groups= DB::table($this->table)
        ->orderBy('name','ASC')
        ->get();
        return $groups;
    }
}
