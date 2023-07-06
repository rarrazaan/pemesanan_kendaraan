<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $fillable = ['role_name', 'grade'];

    public function user(){
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}