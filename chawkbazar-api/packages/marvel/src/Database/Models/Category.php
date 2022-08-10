<?php

namespace Marvel\Database\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use Sluggable;

    protected $table = 'categories';

    public $guarded = [];

    protected $casts = [
        'image' => 'json',
        'banner_image' => 'json',
    ];

    protected $appends = array('parent_id');

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getParentIdAttribute()
    {
        return $this->parent;
    }


    // protected static function boot()
    // {
    //     parent::boot();
    //     // Order by updated_at desc
    //     static::addGlobalScope('order', function (Builder $builder) {
    //         $builder->orderBy('updated_at', 'desc');
    //     });
    // }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }


    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

    /**
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany('Marvel\Database\Models\Category', 'parent', 'id')->with('children')->withCount('products');
    }

    /**
     * @return HasMany
     */
    public function subCategories()
    {
        return $this->hasMany('Marvel\Database\Models\Category', 'parent', 'id')->with('subCategories', 'parent')->withCount('products');
    }

    /**
     * @return HasOne
     */
    public function parent()
    {
        return $this->hasOne('Marvel\Database\Models\Category', 'id', 'parent')->with('parent');
    }
}
