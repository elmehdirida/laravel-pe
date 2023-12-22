<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class OrderProduct extends Model
{
    use HasFactory;
    protected $table = 'product_order';
    public $timestamps = false;
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function product() : BelongsToMany
    {
        return $this->belongsToMany('App\Models\product');
    }
    public function order() : BelongsToMany
    {
        return $this->belongsToMany('App\Models\order');
    }

}
