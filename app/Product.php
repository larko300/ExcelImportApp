<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    /**
     * Get the category of product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
