<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'colors',
        'talles',
        'image_1',
        'image_2',
        'image_3',
        'price',
        'price_send',
        'cantidad',
    ];
}
