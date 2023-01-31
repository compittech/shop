<?php

namespace App\Models;

use App\Traits\Models\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property string slug
 * @property string title
 * @property string thumbnail
 * @property integer price
 */
class Product extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable=[
        'slug',
        'title',
        'thumbnail',
        'price',
        'brand_id'
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

}
