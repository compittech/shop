<?php


namespace App\Traits\Models;


use Illuminate\Database\Eloquent\Model;

trait HasSlug
{

    protected static function bootHasSlug()
    {
        static::creating(function (Model $model) {
            $model->slug = $model->slug ?? str($model->{ self::slugFrom() })->slug();
        });
        //todo ДЗ Урок 2.1 на 19 минуте видео
    }

    public static function slugFrom(): string
    {
        return 'title';
    }
}
