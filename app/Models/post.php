<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Likeable;
use Carbon\Carbon;
use App\Scopes\PostedScope;

class Post extends Model
{

    use Likeable;

    protected static function boot() {
        parent::boot();
        static::addGlobalScope(new PostedScope);
    }

    protected $fillable = [
        'title', 'body', 'image',
        'category_id', 'is_published'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $with = [
        'category', 'user'
    ];

    protected $hidden = [
        'user_id', 'category_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function scopePublished(Builder $query) {
        return $query->where('is_published', true);
    }

    public function scopeDrafted(Builder $query) {
        return $query->where('is_published', false);
    }

    public function scopeSearch(Builder $query, ?string $search) {
        if($search) {
            return $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('slug', 'LIKE', "%{$search}%");
        }
    }

    public function scopeLatest(Builder $query) {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeLastMonth(Builder $query, int $limit = 5) {
        return $query->whereDate('created_at', '>', Carbon::now()->subMonth())
                ->latest()
                ->limit($limit);
    }

    public function scopeLastWeek(Builder $query, int $limit = 5) {
        return $query->whereDate('created_at', '>', Carbon::now()->subWeek())
                ->latest();
    }

    public function scopeAdmin(Builder $query) {
        return $query->where('is_admin', true);
    }

    public function getPublishedAttribute() {
        return ($this->is_published) ? 'Yes' : 'No';
    }

    public function getRelatedPostsAttribute() {
        $tagsId = $this->tags->pluck('id')->toArray();
        $posts = collect();

        if(count($tagsId)) {
            $posts = Post::where('posts.id', '<>', $this->id)
                    ->whereHas('tags', function($query) use ($tagsId) {
                        $query->whereIn('tags.id', $tagsId);
                    })->get();
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

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return Post::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

}
