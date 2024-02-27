<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'price',
        'description',
        'company_id',
        'category_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
