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
}
