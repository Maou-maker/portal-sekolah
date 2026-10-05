<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileTeacher extends Model
{
    protected $fillable = ['name', 'nip', 'position', 'gender', 'address', 'photo', 'role'];
}
