<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    //
    protected $fillable = [
      'name'
    ];

    /**
     * @return BelongsToMany
     */
    public function articles() {
        return $this->belongsToMany(
            'App\Article', 'article_tags', 'tag_id', 'article_id'
        );
    }
}
