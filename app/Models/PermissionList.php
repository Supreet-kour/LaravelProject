<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionList extends Model
{
    protected $table = 'permission_lists';

    protected $fillable = ['id', 'permission_name'];
}
