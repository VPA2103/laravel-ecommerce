<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trasaction extends Model
{
    use HasFactory;
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
