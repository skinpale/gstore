<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo{
        return $this->belongsTo(Subcategory::class);
    }

    public function favorite(): BelongsTo{
        return $this->belongsTo(Favorite::class);
    }

    public function reviews(): HasMany{
        return $this->HasMany(Review::class);
    }
}
