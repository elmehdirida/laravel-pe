<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    public $timestamps = false;
    protected  $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'discount_id',
        'image',
        'rating'
    ];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments() : HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function  order() :BelongsToMany
    {
          return $this->belongsToMany(Order::class,'product_order','product_id','order_id'
          )->withPivot('quantity','price');
    }

    public function  discount() :BelongsTo
    {
        return $this->belongsTo(Discount::class);
    }
}
