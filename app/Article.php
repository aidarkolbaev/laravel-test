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
    public function linkedArticles()
    {
        return $this->belongsToMany(
            'App\Article', 'article_article', 'article_id', 'linked_article_id'
        );
    }
}
