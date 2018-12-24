<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrepaidBalance extends Model
{
    //
    public function order()
    {
        return $this->belongsto(Order::class);
    }
}
