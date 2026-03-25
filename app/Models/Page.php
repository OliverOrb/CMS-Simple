<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Page
 *
 * @property $id
 * @property $user_id
 * @property $title
 * @property $slug
 * @property $body
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @property Comment[] $comments
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Page extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title', 'slug', 'body', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, 'id', 'page_id');
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
