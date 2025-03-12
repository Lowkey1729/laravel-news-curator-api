<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'url',
        'slug',
        'views',
        'clicks',
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->title).Str::ulid()->toBase32();
            $model->url = config('app.url').'/'.$model->slug;
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->title);
            $model->url = config('app.url').'/'.$model->slug;
        });
    }
}
