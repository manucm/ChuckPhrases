<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\Model;

class Joke extends Model
{
    protected $fillable = [
        'icon_url', 'url_id', 'value', 'user_id', 'slug'
    ];

    public function categories() {
        return $this->belongsToMany(Category::class, 'jokes_categories', 'joke_id', 'category_id');
    }
}
