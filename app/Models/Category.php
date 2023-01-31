<?php

namespace App\Models;

use App\Traits\Models\HasSlug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


/**
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property string slug
 * @property string title
 */
class Category extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable=[
        'title',
        'slug'
    ];


    public function products(): BelongsToMany

    {
        return $this->belongsToMany(Product::class);
     }

}
