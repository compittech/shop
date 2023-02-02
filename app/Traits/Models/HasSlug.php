<?php


namespace App\Traits\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasSlug
{

    protected static function bootHasSlug()
    {
        static::creating(function (Model $model) {
            if (empty($model->slug)) {
                $model->slug = self::unique_slug($model);
            }
        });
    }

    public static function slugFrom(): string
    {
        return 'title';
    }

    /**
     * @param $model
     * @return string
     */
    public static function unique_slug($model): string
    {
        $slug = str($model->{self::slugFrom()})->slug();
        $models = get_class($model)::query()->where('slug', 'like', '%' . $slug . '%')->get(['slug']);
        $counter[] = 0;
        foreach ($models as $item) {
            $end = Str::afterLast($item->slug, '-');
            if (is_numeric($end)) {
                $counter[] = (int)$end;
            }
        }
        if ($models->isEmpty()) {
            $append = '';
        } elseif($models->isNotEmpty() AND max($counter) == 0) {
            $append = '-2';
        } else {
            $append = '-'.(max($counter) + 1);
        }
        return $slug->append($append);
    }
}
