<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    /**
     * Get the products of category.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
