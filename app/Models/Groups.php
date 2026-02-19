<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;

    protected $table = 'groups';

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'permissions',
    ];

    public function users(){
        return $this->hasMany(User::class, 'group_id', 'id');
    }

    public function getAll(){
        return $this->all();
    }
}
