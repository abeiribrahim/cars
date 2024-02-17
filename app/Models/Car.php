<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
            'title',
            'content',
            'luggage',
            'doors',
            'passengers',
            'price',
            'image',
            'category_id',
            'status',
];
            public function category(){
                return $this->belongsTo(Category::class);
            }
}
