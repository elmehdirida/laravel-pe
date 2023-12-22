<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';

    protected  $fillable = [
        'order_date',
        'order_status',
        'total_amount',
        'user_id',
    ];



    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class,'product_order','order_id','product_id')
            ->withPivot('quantity','price');
    }

}
