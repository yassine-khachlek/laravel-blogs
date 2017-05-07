<?php

namespace Yk\LaravelBlogs\App;

use Illuminate\Database\Eloquent\Model;
use App;

class Blog extends Model
{
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['locale'];

    /**
     * Get the translations for the blog post.
     */
    public function translations()
    {
        return $this->hasMany('Yk\LaravelBlogs\App\BlogTranslation');
    }

    /**
     * Get the translation for the blog post.
     */
    public function getTranslation($language_code)
    {
        return $this->translations()->where('language_code', $language_code)->first();
    }

    /**
     * Get the locale translation for the blog post.
     */
    public function getLocaleAttribute()
    {
        return $this->getTranslation(App::getLocale());
    }

    public function getSlugAttribute() {
        return str_slug($this->locale->title, '-');
    }

    public function getTitleAttribute() {
        return str_limit($this->locale->title, 60, '');
    }

    public function getDescriptionAttribute() {
        return str_limit(preg_replace('/\s+/', ' ', trim(strip_tags(str_replace("&nbsp;", " ", $this->locale->body)))), 160, '...');
    }

    public function getMetaTitleAttribute() {
        return $this->title;
    }

    public function getMetaDescriptionAttribute() {
        return $this->description;
    }
}
