<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Sortable\Sortable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use Sluggable, SoftDeletes, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'cover',
        'hero_type',
        'hero',
        'posted_at',
        'meta_title',
        'meta_description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany(User::class, 'posts_authors');
    }

    /**
     * Function to truncate the body attribute called directly or through the body_truncated mutator
     *
     * @param int $length
     * @return string
     */
    public function bodyTruncated($length = 100)
    {
        if (!empty($this->attributes['meta_description'])) {
          return custom_truncate($this->attributes['meta_description'], $length);
        }
        return custom_truncate($this->attributes['body'], $length);
    }
    /**
     * Mutator to truncate the body text length
     *
     * @return string
     */
    public function getBodyTruncatedAttribute()
    {
        return $this->bodyTruncated();
    }

    /**
     * @return bool
     */
    public function gethasTagsAttribute()
    {
        return !!$this->tags->count();
    }

    /**
     * Mutator to get the human readable date since post was published.
     * i.e. it is easier for humans to read 1 month ago compared to 30 days ago or the date.
     * @return [type] [description]
     */
    public function getDatePostedHumanAttribute()
    {
      $datePosted = Carbon::parse($this->attributes['created_at']);
      $now = Carbon::now();
      $diffInDays = $datePosted->diffInDays($now);
      $diffInDaysHuman = $now->subDays($datePosted->diffInDays($now))->diffForHumans();
      $diffInMinutesHuman = $now->subMinutes($datePosted->diffInMinutes($now))->diffForHumans();
      $maxDiff = $datePosted->diffInDays($datePosted->copy()->addMonth(2));
      $datePostedHuman = $datePosted->format('M d, Y');

      if ($diffInDays == 0) {
        $datePostedHuman = $diffInMinutesHuman;
      } elseif ($diffInDays >= 1 && $diffInDays <= $maxDiff) {
        $datePostedHuman = $diffInDaysHuman;
      }

      return $datePostedHuman;
    }

    /**
     * Mutator to generate hero alt
     * @return [type] [description]
     */
    public function getHeroAltAttribute()
    {
      return generateAlt($this->attributes['hero']);
    }

    /**
     * Mutator to generate cover alt
     * @return [type] [description]
     */
    public function getCoverAltAttribute()
    {
      return generateAlt($this->attributes['cover']);
    }

    /**
     * @param string $field
     * @return mixed|string
     */
    public function html($field = 'body')
    {
        $text = $this->attributes[$field];
        $parsedown = new \ParsedownExtra();

        return $parsedown->setBreaksEnabled(true)->text($text);
    }

    /**
     * Get resized image
     *
     * @param $image
     * @param string $size
     * @return string
     */
    public function image($image, $size = 'large.16:9')
    {
        $image = $this->attributes[$image];
        $url = sprintf('pics/blog/%s/%s', $size, $image);

        return url($url);
    }

    public function relatedDesigners()
    {
        return $this->morphedByMany(Designer::class, 'related', 'posts_related');
    }

    public function relatedPosts()
    {
        return $this->morphedByMany(Post::class, 'related', 'posts_related');
    }

    public function relatedProducts()
    {
        return $this->morphedByMany(Product::class, 'related', 'posts_related');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return ['slug' => ['source' => 'title']];
    }

    /**
     * Get all of the tags for the post.
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
