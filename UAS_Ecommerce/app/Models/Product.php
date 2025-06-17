<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    //
     use HasFactory;

    protected $primaryKey = 'product_code';
    public $incrementing = false;
    protected $keyType = 'string'; 

    protected $fillable = [
        'name',
        'description',
        'price'
    ];

    protected static function booted()
{
    static::creating(function ($product) {
        $product->product_code = 'PRD-' . date('Ymd') . '-' . strtoupper(Str::random(5));
    });
}

}
