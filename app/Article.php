<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    //
    protected $fillable = [
        'title',
        'content'
    ];

    /**
     * Get the author of article
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


    /**
     * @return BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(
            'App\Article', 'article_article', 'article_id', 'linked_article_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function tags() {
        return $this->belongsToMany(
            'App\Tag', 'article_tag', 'article_id', 'tag_id'
        );
    }
}
