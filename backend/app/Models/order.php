<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{ 
    use HasFactory;
    protected $guarded=[];

    public function orderItems()
    {
        return $this->hasMany(order_items::class, 'OrderID');
    }

    public function saveOrders($data){
        return $this->create($data);
    }

}
