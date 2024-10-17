<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'amount',
        'category',
        'type',
        'date',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
