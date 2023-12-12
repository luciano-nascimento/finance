<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'amount', 'date', 'category_id'];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, "id", "category_id");
    }
}
