<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses'; // nếu bảng của bạn tên là addresses

    protected $fillable = [
        'name',
        'phone',
        'zip',
        'state',
        'city',
        'address',
        'locality',
        'landmark',
        'country',
        'user_id',
        'isdefault',
    ];
}
