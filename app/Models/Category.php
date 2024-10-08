<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function businesses(): BelongsToMany
    {
        return $this->belongsToMany(Business::class, 'business_category', 'category_id', 'business_id');
    }
}
