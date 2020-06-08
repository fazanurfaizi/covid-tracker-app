<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Likeable;
use Carbon\Carbon;

class Post extends Model
{

    use Likeable;

    protected $fillable = [
        'title', 'body', 'image',
        'category_id', 'is_published'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $with = [
        'category', 'user', 'comments'
    ];

    protected $hidden = [
        'user_id', 'category_id'
    ];

    /**
     * Post Model Relationships
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->withCount('likes')->orderBy('created_at', 'desc');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * Custom Post Model Scopes
     */
    public function scopePublished(Builder $query) {
        return $query->where('is_published', true);
    }

    public function scopeDrafted(Builder $query) {
        return $query->where('is_published', false);
    }

    /**
     * Custom Post Model Attributes
     */
    public function getPublishedAttribute() {
        return ($this->is_published);
    }

    public function getRelatedPostsAttribute() {
        $tagsId = $this->tags->pluck('id')->toArray();
        $posts = collect();

        if(count($tagsId)) {
            $posts = Post::where('posts.id', '<>', $this->id)
                    ->whereHas('tags', function($query) use ($tagsId) {
                        $query->whereIn('tags.id', $tagsId);
                    })->limit(3)->get();
        }

        return $posts;
    }

    public function getTagListAttribute() {
        return $this->tags->pluck('name')->toArray();
    }

    public function getImageUrlAttribute() {
        if($this->image !== null) {
            return asset('uploads/posts/' . $this->image);
        }
    }

    /**
     * Create Unique Post Slug
     */
    public function createSlug($title, $id = 0)
    {
        $slug = str_slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new Exception('Can not create a unique slug');
    }

    /**
     * Check if Slug is already used
     */
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Post::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

}
